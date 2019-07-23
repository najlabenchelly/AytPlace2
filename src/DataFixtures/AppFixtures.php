<?php

namespace App\DataFixtures;

use App\Entity\Ad;
use Faker\Factory;
use App\Entity\Role;
use App\Entity\User;
use App\Entity\Image;
use App\Entity\Booking;
use App\Entity\Comment;
use Cocur\Slugify\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture

{
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder){
        $this->encoder =$encoder;
    }
    
    public function load(ObjectManager $manager)
    {

        $faker = Factory::create('fr_FR');
        $adminRole = new Role();
        $adminRole -> setTitle('ROLE_ADMIN');
        $manager->persist($adminRole);

       //$slugify= new Slugify();
         
        $adminUser= new User();
        $adminUser->setFirstname('Najla')
                  ->setLastname('Chelly')
                  ->setEmail('Chelly.n@gmail.com')
                  ->setHash($this->encoder->encodePassword($adminUser, 'root'))
                  ->setPicture('https://avatar.io/instagram/_newnew_n')
                  ->setIntroduction($faker->sentence())
                  ->setDescription('<p>' . join ('</p><p>', $faker->paragraphs(3)) . '</p>')
                  ->addUserRole($adminRole);
            $manager->persist($adminUser);
                 
                   

        //geestion utilisateur 
        $users =[];
        $genres=['male','female'];


       for( $i= 1; $i <=10; $i++){
           $user = new User();
           $genre = $faker->randomElement($genres);
           $picture = 'https://randomuser.me/api/portraits/';
           $pictureId =$faker->numberBetween(1,99) . '.jpg';
           
           $picture .= ($genre == 'male' ? 'men/' : 'women/') . $pictureId ;
           $hash = $this->encoder->encodePassword($user, 'root');

           $user ->setFirstname($faker->firstname)
                 ->setLastname($faker->lastname)
                 ->setIntroduction($faker->sentence())
                 ->setEmail($faker->email)
                 ->setDescription('<p>' . join ('</p><p>', $faker->paragraphs(3)) . '</p>')
                 ->setHash($hash)
                 ->setPicture($picture);

            
        $manager->persist($user);
        $users[] =$user;

        
        
       }
        
        //gestion annonce


        for( $i= 1; $i <=10; $i++){
        $ad = new Ad();

        $title=$faker->sentence(1);
     
        $coverImage= $faker->imageUrl(1000,350);
        $introduction=$faker ->paragraph(3);
        $content='<p>' . join ('</p><p>', $faker->paragraphs(2)) . '</p>';

        $user = $users[mt_rand(0, count($users) -1)];

        $ad->setTitle($title)
           ->setCoverImage($coverImage)
           ->setIntroduction($introduction)
           ->setContent($content)
           ->setPrice(mt_rand(200,990))
           ->setRooms(mt_rand(1, 5))
           ->setAuthor($user);

           //creation image relieer à ad 
   
        for($j= 1; $j <= mt_rand(2, 5); $j++) {
            $image = new Image();
            $image->setUrl($faker->imageUrl())
                  ->setCaption($faker->sentence())
                  ->setAd($ad);

            $manager->persist($image);
        }
        //Gestion des rerservations
      for($j= 1; $j <= mt_rand(0, 10); $j++) {
          $booking= new Booking();
          $createdAt = $faker->dateTimeBetween('-6 months');
          $startDate = $faker->dateTimeBetween('- 3 months');
          //gestion date fin sejour
          $duration = mt_rand(3,10);
          $endDate = (clone $startDate)->modify("+$duration days");
          $amount = $ad->getPrice() * $duration;
          $booker= $users[mt_rand(0,count($users)-1)];
          $comment = $faker->paragraph(1);
          $booking->setBooker($booker)
                  ->setAd($ad)
                  ->setStartDate($startDate)
                  ->setEndDate($endDate)
                  ->setCreatedAt($createdAt)
                  ->setAmount($amount)
                  ->setComment($comment);

        $manager->persist($booking);

        //gestion des commeentaires
                        if(mt_rand(0, 1)) {
                    $comment = new Comment();
                    $comment->setContent($faker->paragraph())
                            ->setRating(mt_rand(1, 5))
                            ->setAuthor($booker)
                            ->setAd($ad);
                            
                    $manager->persist($comment);
                }
            }

            $manager->persist($ad);
        }
        

        $manager->flush();
    }
}

      