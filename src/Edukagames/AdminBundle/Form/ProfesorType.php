<?php

namespace Edukagames\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProfesorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre' )
            ->add('password', 'repeated', array(
            'type' => 'password',
            'required' => false,
            'invalid_message' => 'Las dos contrasenas deben coincidir',
            'first_name' =>"Contrasena",
            'second_name' =>"Repita_contrasena",
            'error_bubbling' => 'true'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Edukagames\AdminBundle\Entity\Profesor'
        ));
    }

    public function getName()
    {
        return 'edukagames_adminbundle_profesortype';
    }
}
