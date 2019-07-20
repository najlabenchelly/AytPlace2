<?php

namespace App\Form;

use App\Entity\Ad;
use App\Form\ImageType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AnnonceType extends AbstractType
{
    /**
     * permet d'avoir la config de base d'un champs 
     * @param string $label
     * @param string $placeholder
     * @param bool $required
     * @return array
     */

    private function getConfiguration($label, $placeholder, $required= TRUE){
        return [
            'label'=> $label,
                'attr' => [
                    'placeholder'=> $placeholder
                ],
             'required' =>$required ];

    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add(
                'title',TextType::class,
                 $this-> getConfiguration("Titre","Tapez un titre pour votre annnonce")
                 )
            ->add('slug',TextType::class,
                 $this-> getConfiguration("Adressee web","Tapez un titre pour votre adresse web ", 
FALSE))
            
            ->add('introduction',TextType::class,
             $this-> getConfiguration("Description ","Donnez une description globale de l'annonce "))
            ->add('content',TextareaType::class,
             $this-> getConfiguration("Description détaillée ","Donnez une description détaillé de l'annonce "))
            ->add('coverImage',UrlType::class, 
            $this-> getConfiguration("URL dee l'image principale", "Donnez l'adresse de la photo que vous souhaitez en premier plan"))
            ->add('rooms',IntegerType::class, 
            $this-> getConfiguration("Nombre de pièces proposé ", "Nombre de pièces disponible "))
            ->add('price',MoneyType::class,
             $this-> getConfiguration("Prix par jour","Indiquez le prix par jour"))
            ->add('images',CollectionType::class, [

                'entry_type' => ImageType::class,
                'allow_add' => true,
                'allow_delete'=>true,
                'by_reference' => false ,

            ]
         );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
            
        ]);
    }
}
