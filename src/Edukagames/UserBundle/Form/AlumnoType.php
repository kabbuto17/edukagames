<?php

namespace Edukagames\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AlumnoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('apellidos')
            ->add('password')
            ->add('salt')
            ->add('diagnostico')
            ->add('curso')
            ->add('fechaNacimiento')
            ->add('userName')
            ->add('foto')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Edukagames\UserBundle\Entity\Alumno'
        ));
    }

    public function getName()
    {
        return 'edukagames_userbundle_alumnotype';
    }
}
