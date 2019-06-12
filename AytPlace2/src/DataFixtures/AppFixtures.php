<?php

namespace App\DataFixtures;

use App\Entity\Ad;
use Faker\Factory;
use App\Entity\User;
use App\Entity\Image;
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

        $faker = Factory::create('FR-fr');
       //$slugify= new Slugify();
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
                 ->setDescription('<p>' . join ('</p><p>', $faker->paragraphs(1)) . '</p>')
                 ->setHash($hash)
                 ->setPicture($picture);

            
        $manager->persist($user);
        $users[] =$user;

        
        
       }
        
        //gestion annonce


        for( $i= 1; $i <=30; $i++){
        $ad = new Ad();

        $title=$faker->sentence(1);
     
        $coverImage= $faker->imageUrl(1000,350);
        $introduction=$faker ->paragraph(2);
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
        
      
        $manager->persist($ad);
    }

        $manager->flush();

    
    

        // $manager->persist($product);

      
    }
}
