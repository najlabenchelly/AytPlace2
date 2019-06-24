<?php

namespace App\Form;

use App\Entity\Ad;
use App\Entity\User;
use App\Entity\Booking;
use Doctrine\DBAL\Types\FloatType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class AdminBookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('startDate', DateType::class)
            ->add('endDate', DateType::class)
            ->add('comment')
            ->add('booker', EntityType::class, [
                'class' => User::class,
                'choice_label' => function($user)  {
                    return $user->getFirstName() . " " . strtoupper($user->getLastName());
                }
            ])
            ->add('amount', NumberType::class)
            ->add('ad', EntityType::class, [
                'class' => Ad::class,
                'choice_label' => 'title'
            ])
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
}
