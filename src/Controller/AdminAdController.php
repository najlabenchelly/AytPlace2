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
    public function index(AdRepository $repo)
    {
        return $this->render('admin/ad/index.html.twig', [
            'ads' => $repo->findAll()
        ]);
    }
     /**
     * formulaire d'édition annonce
     * 
     * @Route("/admin/ads/{id}/edit", name="admin_ads_edit")
     *
     * @param Ad $ad
     * @return Response
     */
    public function edit(Ad $ad, Request $request,ObjectManager $manager) {
        $form = $this->createForm( AnnonceType::class, $ad);
        $form-> handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $manager->persist($ad);
            $manager->flush();
           
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