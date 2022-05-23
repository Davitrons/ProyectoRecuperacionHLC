<?php

namespace App\Form;

use App\Entity\Localizacion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocalizacionType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add('codigo' , TextType::class)
            ->add('nombre' , TextType::class)
            ->add('descripcion' , TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults([
            'data_class' => Localizacion::class
        ]);
    }

}