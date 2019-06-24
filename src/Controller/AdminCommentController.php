<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\AdminCommeentType;
use App\Repository\CommentRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class AdminCommentController extends AbstractController
{
    /**
     * @Route("/admin/comments/", name="admin_comment_index")
     */
    public function index()
    {
        return $this->render('admin/comment/index.html.twig', [
            'comments' => $this->getDoctrine()->getRepository(Comment::class)->findAll(),
        ]);
    }

    /**
     * Modification d'un commentaire
     * @Route("/admin/comments/{id}/edit", name="admin_comment_edit")
     * @return Response
     */
    public function edit(Comment $comment, Request $request) {
        $form = $this->createForm(AdminCommeentType::class, $comment);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($comment);
            $em->flush();

            $this->addFlash('success',"Le commentaire {$comment->getId()} a bien été modifié");
        }
        return $this->render('admin/comment/edit.html.twig', [
                'comment' => $comment,
                'form' => $form->createView()
        ]);
    }

    /**
     * Supprimee un commentaire
     * @Route("/admin/comments/{id}/delete", name="admin_comment_delete")
     * @param Comment $comment
     * @param ObjectManager $manager
     * @return Response
     */
    public function delete(Comment $comment) {
        $em = $this->getDoctrine()->getManager();

        $em->remove($comment);
        $em->flush();

        $this->addFlash('success',"Le commentaire a bien été supprimé !");

        return $this->redirectToRoute('admin_comment_index');
    }
}

