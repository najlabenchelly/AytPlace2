<?php

namespace App\Controller;

use App\Entity\Ad;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\AdRepository;

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
 * permet d'afficher unee seeule annonce 
 * 
 * @Route("/ads/{slug}", name="ads_show")
 * 
 * @return Response
 */
public function show($slug, AdRepository $repo){
    //Je recupere l'annonce qui correspond au slug 
    $ad = $repo-> findOneBySlug($slug);

    return $this ->render('ad/show.html.twig',[
        'ad'=> $ad

    ]);

  }
}
