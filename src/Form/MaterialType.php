<?php

namespace App\Form;

use App\Entity\Localizacion;
use App\Entity\Material;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MaterialType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add('nombre' , TextType::class)
            ->add('descripcion' , TextType::class)
            ->add('localizacion', EntityType::class, [
                'class' => Localizacion::class,
                'placeholder' => 'No asociado a ninguna localizacion'
            ])
            ->add('disponible', ChoiceType::class, [
                'choices' => [
                    'Sí' => true,
                    'No' => false
                ],
                'expanded' => true
            ])
            ->add('fechaAlta' , DateType::class)
            ->add('fechaBaja', DateType::class)
            ->add('fechaHoraUltimaDevolucion', DateType::class)
            ->add('fechaHoraUltimoPrestamo', DateType::class);
    }

    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults([
            'data_class' => Material::class
        ]);
    }

}