<?php
namespace App\Controller;


use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AccountController extends AbstractController
{
    /**
     * authentification 
     * @Route("/login", name="account_login")
     * @param AuthenticationUtils $utils
     * @return Response
     */
    public function login(AuthenticationUtils $utils)
    {
        $error = $utils->getLastAuthenticationError();
        $username = $utils->getLastUsername();
        return $this->render('account/login.html.twig', [
            'hasError' => $error !== null,
            'username' => $username,
        ]);
    }
    /**
     * Deconnexion
     * 
     * @Route("/logout", name="account_logout")
     *
     * @return void
     */
    public function logout() {
     
    }

    /**
     * Formulaire d'inscription
     *
     * @Route("/register", name="account_register")
     * 
     * @return Response
     */

    public function register(){
        $user = new User();
        $form= $this -> createForm(RegistrationType::class, $user);
    return $this -> render ('account/registration.html.twig',[
            'form' => $form->createView()

        ]);


    }



}
