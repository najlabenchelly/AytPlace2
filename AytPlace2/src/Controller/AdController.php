<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Form\AnnonceType;
use App\Repository\AdRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdController extends AbstractController
{
    /**
     * @Route("/ads", name="ads_index")
     */

public function index(AdRepository $repo)
    {
        $ads = $repo->findAll();
        return $this->render('ad/index.html.twig', [
            'ads' => $ads
        ]);
    }

 /**
  * peermeet de creeer une annoncee 
  * 
  * @Route("/ads/newAd", name="ads_create")
  *
  * @return Response
  */


public function create(Request $request ,ObjectManager $manager){
    $request->request->get('title');

    $ad = new Ad();
    $form= $this->createForm(AnnonceType::class, $ad);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()){
        
        $manager->persist($ad);
        $manager->flush();


    }
                 
    return $this->render('ad/newAd.html.twig',[
        'form' => $form->createView()
        ]);

    }
/**
 * permet d'afficher unee seeule annonce 
 * @Route("/ads/{slug}", name="ads_show")
 * @return Response
 */

public function show($slug,AdRepository $repo){
    //Je recupere l'annonce qui correspond au slug 
    $ad = $repo-> findOneBySlug($slug);

    return $this->render('ad/show.html.twig',[
        'ad'=> $ad

    ]);

  }
  
}
