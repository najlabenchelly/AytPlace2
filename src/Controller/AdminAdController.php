<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Form\AnnonceType;
use App\Repository\AdRepository;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminAdController extends AbstractController
{
    /**
     * @Route("/admin/ads",name="admin_ads_index")
     */
    public function index()
    {
        return $this->render('admin/ad/index.html.twig', [
            'ads' => $this->getDoctrine()->getRepository(Ad::class)->findAll()
        ]);
    }

    /**
     * formulaire d'édition annonce
     *
     * @Route("/admin/ads/{id}/edit", name="admin_ads_edit")
     *
     * @param Ad $ad
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Ad $ad, Request $request) {
        $form = $this->createForm( AnnonceType::class, $ad);
        $form-> handleRequest($request);

        if($form->isSubmitted()&& $form->isValid()){
            $em = $this->getDoctrine()->getManager();

            $em->persist($ad);
            $em->flush();

            $this->addFlash(
                'success',
                "l'enregistrement {$ad->getTitle()} s'est bien effectué "
            );

        }
        return $this->render('admin/ad/edit.html.twig',[
            'ad'=>$ad,
            'form'=> $form->createView()
        ]);
    }
}
