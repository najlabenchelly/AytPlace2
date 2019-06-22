<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Entity\Booking;
use App\Entity\Comment;
use App\Form\BookingType;
use App\Form\CommentType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookingController extends AbstractController
{
    /**
     * @Route("/ads/{slug}/book", name="booking_create")
     * @IsGranted("ROLE_USER")
     */
    public function book(Ad $ad, Request $request,ObjectManager $manager)

    {
        $booking = new Booking();
        $form =$this->createForm(BookingType::class, $booking);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $user = $this->getUser();

            $booking->setBooker($user)
                    ->setAd($ad);
    // si les datee ne sont pas dispo messagee err 
    if(!$booking->isBookableDates()) {
    $this->addFlash(
        'warning',
        "Les dates choisies sont indisponible"
    );
    
}else{


            $manager->persist($booking);
            $manager->flush();

            return $this->redirectToRoute('booking_show',['id'=> $booking->getId(),
            'withAlert'=>true]);

        }
    }

        return $this->render('booking/book.html.twig', [
            'ad' => $ad,
            'form'=> $form->createView()
        ]);

    }

    /**
     * affichage de la page réservation 
     *@Route("/booking/{id}",name="booking_show")
     * @param Booking $Booking
     * @return Response
     */
    public function show(Booking $Booking){
        return $this->render("booking/show.html.twig",[

            'booking'=>$Booking
        ]);

    }
}
