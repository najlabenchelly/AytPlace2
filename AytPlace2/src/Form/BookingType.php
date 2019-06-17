<?php

namespace App\Form;

use App\Entity\Booking;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class BookingType extends AbstractType
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
            ->add('startDate', DateType::class, $this->getConfiguration("Date d'arrivée", "Date à laquelle vous souhaitez arriver",["widget" => "single_text"]))
            ->add('endDate', DateType::class, $this->getConfiguration("Date de départ", "Date à laquelle vous souhaitez quitter les lieux ", ["widget" => "single_text"]))
            ->add('comment', TextareaType::class,$this->getConfiguration("Commentaire", "Si vous avez un commentaire n'hesitez pas à nous en fairee part "))
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
}
