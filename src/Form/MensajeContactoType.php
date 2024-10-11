<?php

namespace App\Form;

use App\Entity\MensajeContacto;
use App\Entity\AreaContacto;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MensajeContactoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', TextType::class)
            ->add('apellido', TextType::class)
            ->add('correo', EmailType::class)
            ->add('celular', TelType::class)
            ->add('areaContacto', EntityType::class, [
                'class' => AreaContacto::class,
                'choice_label' => 'nombre',
                'placeholder' => 'Seleccione un área de contacto',
            ])
            ->add('mensaje', TextareaType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MensajeContacto::class,
        ]);
    }
}
