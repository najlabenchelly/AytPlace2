<?php

namespace App\Controller;

use App\Service\StatService;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminDashboardController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_dashboard")
     */
    public function index(ObjectManager $manager , StatService $statService)
    {

      // requête Dql 
         //
        // $ads = $statService->getAdsCount();
       // $bookings =$statService->getBookingsCount();
       // $comments = $statService->getCommentsCount();
       $stat =$statService->getStat();
        
        $bestAd = $statService->getAdStat('DESC');
            dump($bestAd);
        $worstAd = $statService->getAdStat('ASC');
            dump($worstAd);


 

        return $this->render('admin/dashboard/index.html.twig', [
            'stats' =>$stat,
            'bestAds'=> $bestAd,
            'worstAds'=>$worstAd,
        ]);
    }
}
