<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class HomeController extends AbstractController{
/**
 * @Route("/", name="homepage")
 */

public function home(){
    //test

    $prenoms=["Nom1"=>31,"Jnom2"=>12,"nom3"=>32];
    return $this->render(
        'home.html.twig',
        [ 'title' => "aurevoir tout le monde ",
          'age'=>"12",
          'tableau'=> $prenoms,
        
        ]
    );



}


}