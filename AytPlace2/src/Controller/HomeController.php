<?php
/**
 * Created by PhpStorm.
 * User: elgrim
 * Date: 28/02/19
 * Time: 21:22
 */
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller {
/**
 * @Route("/", name="homepage")
 */

public function home(){
    $prenoms=["Lior"=>31,"Joseph"=>12,"anne"=>32];
    return $this->render(
        'home.html.twig',
        [ 'title' => "aurevoir tout le monde ",
          'age'=>"12",
          'tableau'=> $prenoms,
        
        ]
    );



}


}