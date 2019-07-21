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

    public function avgRatings(Ad $ad) {
        // Calculer la somme des notations
        $comments = $ad->getComments()->toArray();
        $sum = array_reduce($comments, function($total, $comment) {
            return $total + $comment->getRating();
        }, 0);
        return  (count($comments) > 0) ? $sum / count($comments) :  0;
    }
}
