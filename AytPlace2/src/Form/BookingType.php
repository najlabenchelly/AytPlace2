<?php

namespace App\Form;

use App\Entity\Booking;
use App\Form\DataTransformer\FrenchDate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class BookingType extends AbstractType
{  
    // injeection de dépendance
    private $transformer;
    public function __construct(FrenchDate  $transformer){
        $this->transformer=$transformer;

    }
    
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
            ->add('startDate',TextType::class, $this->getConfiguration("Date d'arrivée", "Date à laquelle vous souhaitez arriver"))
            ->add('endDate', TextType::class, $this->getConfiguration("Date de départ", "Date à laquelle vous souhaitez quitter les lieux "))
            ->add('comment', TextareaType::class,$this->getConfiguration("Commentaire", "Si vous avez un commentaire n'hesitez pas à nous en fairee part ",FALSE ))
            
        ;
        $builder->get('startDate')->addModelTransformer($this->transformer);
        $builder->get('endDate')->addModelTransformer($this->transformer);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
}
