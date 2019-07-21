<?php


namespace App\EventListener\Entity;


use App\Entity\Booking;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

class BookingListener
{
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof Booking) {
            if(empty($entity->getCreatedAt())) {
                $entity->setCreatedAt(new \DateTime());
            }

            if(empty($entity->getAmount())) {
                // prix de l'annonce * nombre de jour
                $entity->setAmount($entity->getAd()->getPrice() * $entity->getDuration()) ;
            }
        }

    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof Booking) {
            if(empty($entity->getCreatedAt())) {
                $entity->setCreatedAt(new \DateTime());
            }

            if(empty($entity->getAmount())) {
                // prix de l'annonce * nombre de jour
                $entity->setAmount($entity->getAd()->getPrice() * $entity->getDuration()) ;
            }
        }
    }
}
