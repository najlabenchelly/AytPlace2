<?php


namespace App\Twig;


use App\Entity\Ad;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AdExtension extends AbstractExtension
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getFilters()
    {
        return [
            new TwigFilter('avgRatings', [$this, 'avgRatings'])
        ];
    }

    public function avgRatings(Ad $ad)
    {
        $adRepository = $this->em->getRepository(Ad::class);

        return number_format($adRepository->avgRatings($ad), 1,',', ' ');
    }
}
