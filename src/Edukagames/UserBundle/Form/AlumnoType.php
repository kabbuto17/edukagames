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
            ->add('password', 'repeated', array(
            		'type' => 'password',
 					'required' => false,
					'invalid_message' => 'Las dos contrasenas deben coincidir',
					'first_name' =>"Contrasena",
					'second_name' =>"Repita_contrasena",
					'error_bubbling' => 'true'))
            ->add('diagnostico', 'textarea')
            ->add('curso')
            ->add('fechaNacimiento', 'date', array(
				    'input'  => 'datetime',
				    'widget' => 'single_text',
            		'format' => 'dd-MM-yyyy',
            		'invalid_message' => 'El formato de la fecha o la fecha no son correctos. DD-MM-YYYY',))
            ->add('userName')
            ->add('foto','file', array(
					'required' => false,
					'data_class' => null))
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
