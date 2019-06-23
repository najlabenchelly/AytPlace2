<?php

namespace App\Form;

use App\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CommentType extends AbstractType

{
    /**
     * permet d'avoir la config de base d'un champs 
     * @param string $label
     * @param string $placeholder
     * @param array $options
     * @return array
     */
    private function getConfiguration($label, $placeholder, $options=[]){
        return array_merge_recursive([
            'label'=> $label,
                'attr' => [
                    'placeholder'=> $placeholder
                ]
        ],$options);

    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            ->add('rating',IntegerType::class,$this->getConfiguration("Notee sur 5","Veuillez saisir une note de 0 à 5 ",[
                'attr'=>[
                    'min'=>0,
                    'max'=>5,
                ]
            ]))
            ->add('content',TextareaType::class,$this->getConfiguration("Laissez un avis ",""))
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
