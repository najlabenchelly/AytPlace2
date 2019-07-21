<?php


namespace App\EventListener\Entity;


use App\Entity\Booking;
use App\Entity\User;
use Cocur\Slugify\Slugify;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

class UserListener
{
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof User) {
            if(empty($entity->getSlug())) {
                $slugify = new Slugify();
                $entity->setSlug($slugify->slugify($entity->getFirstname() .' '.$entity->getLastname())) ;
            }
        }

    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof User) {
            if(empty($entity->getSlug())) {
                $slugify = new Slugify();
                $entity->setSlug($slugify->slugify($entity->getFirstname() .' '.$entity->getLastname())) ;
            }
        }
    }
}
