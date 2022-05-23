<?php

namespace App\Form;

use App\Entity\Persona;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonaType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add('nombre' , TextType::class)
            ->add('apellidos' , TextType::class)
            ->add('nombreUsuario' , TextType::class)
            ->add('clave', TextType::class)
            ->add('administrador', ChoiceType::class, [
                'choices' => [
                    'Sí' => true,
                    'No' => false
                ],
                'expanded' => true
            ])
            ->add('gestorPrestamos', ChoiceType::class, [
                'choices' => [
                    'Sí' => true,
                    'No' => false
                ],
                'expanded' => true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults([
            'data_class' => Persona::class
        ]);
    }

}