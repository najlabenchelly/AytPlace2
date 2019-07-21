<?php

namespace App\Repository;

use App\Entity\Ad;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Ad|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ad|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ad[]    findAll()
 * @method Ad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Ad::class);
    }


    public function findBestAd($maxRes){
        return $this->createQueryBuilder('a')
            ->select('a as annonce,AVG(c.rating) as avgRatings')
            ->join('a.comments','c')
            ->groupBy('a')
            ->orderBy('avgRatings','DESC')
            ->setMaxResults($maxRes)
            ->getQuery()
            ->getResult();

    }

    // /**
    //  * @return Ad[] Returns an array of Ad objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
    public function avgRatings(Ad $ad) {
        // Calculer la somme des notations
        $comments = $ad->getComments()->toArray();
        $sum = array_reduce($comments, function($total, $comment) {
            return $total + $comment->getRating();
        }, 0);


        return  (count($comments) > 0) ? $sum / count($comments) :  0;
    }
}
