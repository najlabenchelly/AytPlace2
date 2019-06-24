<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Form\AdminBookingType;
use App\Repository\BookingRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminBookingController extends AbstractController
{
    /**
     * @Route("/admin/bookings", name="admin_booking_index")
     */
    public function index()
    {
        return $this->render('admin/booking/index.html.twig', [
            'bookings' => $this->getDoctrine()->getRepository(Booking::class)->findAll()
        ]);
    }
    /**
     * Edition d' une réservation
     * @Route("/admin/bookings/{id}/edit", name="admin_booking_edit")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Booking $booking, Request $request) {
        $form = $this->createForm(AdminBookingType::class, $booking);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($booking);
            $em->flush();

            $this->addFlash(
                'success',
                "La réservation n°{$booking->getId()} a bien été modifiée"
            );

            return $this->redirectToRoute("admin_booking_index");
        }

        return $this->render('admin/booking/edit.html.twig', [
            'form' => $form->createView(),
            'booking' => $booking
        ]);
    }

    /**
     * Suppression d'une réservation
     * @Route("/admin/bookings/{id}/delete", name="admin_booking_delete")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(Booking $booking) {
        $em = $this->getDoctrine()->getManager();

        $em->remove($booking);
        $em->flush();

        $this->addFlash(
            'success',
            "La réservation est bien supprimée"
        );

        return $this->redirectToRoute("admin_booking_index");
    }
}

