<?php

namespace App\Form;

use App\Entity\Ad;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class AnnonceType extends AbstractType
{
    /**
     * permet d'avoir la config de base d'un champs 
     * @param string $label
     * @param string $placeholder
     * @return array
     */

    private function getConfiguration($label,$placeholder){
        return ['label'=> $label,
                'attr' =>[
                    'placeholder'=> $placeholder
                ]

            ];

    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        
            ->add('title',TextType::class, $this->getConfiguration('Titre','tapez un titre pour votre annnonce'))
            ->add('slug',TextType::class, $this->getConfiguration('Adressee web','tapez un titre pour votre adresse web '))
            ->add('price',MoneyType::class, $this->getConfiguration('Prix par jour','Indiquez le prix souhaiter par jour'))
            ->add('introduction',TextType::class, $this-> getConfiguration("Description ","Donnez une description globale de l'annonce "))
            ->add('content',TextType::class, $this-> getConfiguration("Description détaillé ","Donnez une description détaillé de l'annonce "))
            ->add('coverImage',UrlType::class, $this->getConfiguration("URL dee l'image principale", "Donnez l'adresse de la photo que vous souhaitez en premier plan"))
            ->add('rooms',IntegerType::class, $this->getConfiguration("Nombre de pièces proposé ", "Nombre de pièces disponible "))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
