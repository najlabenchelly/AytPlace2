<?php
namespace App\Service;

use Doctrine\Common\Persistence\ObjectManager;



class StatService {
    private $manager;

    public function __construct(ObjectManager $manager){
        $this->manager = $manager;
    }

    public function getStat(){
        $users =$this->getUserCount();
        $ads = $this->getAdCount();
        $bookings = $this->getBookingCount();
        $comments = $this->getCommentCount();
       return compact('users','ads','bookings','comments');
    }
    public function getUserCount() {
        return $this->manager->createQuery('SELECT COUNT(u) FROM App\Entity\User u')->getSingleScalarResult();
    }
    public function getAdCount() {
        return $this->manager->createQuery('SELECT COUNT(a) FROM App\Entity\Ad a')->getSingleScalarResult();

    }
    public function getBookingCount() {
        return $this->manager->createQuery('SELECT COUNT(b) FROM App\Entity\Booking b')->getSingleScalarResult();
    }

    public function getCommentCount(){
        return $this->manager->createQuery('SELECT COUNT(c) FROM App\Entity\Comment c')->getSingleScalarResult();
    }


    public function getAdStat($order){
         return $this->manager->createQuery(

            'SELECT AVG(c.rating)as note, a.title, a.id, u.firstname, u.lastname, u.picture 
            FROM App\Entity\Comment c
            JOIN c.ad a
            JOIN a.author u
            GROUP BY a 
            ORDER BY note  ' . $order
            )
            ->setMaxResults(5)
            ->getResult();
    }

}
