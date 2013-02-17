<?php

namespace Edukagames\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class InformeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombreInforme','file', array('required' => false,'data_class' => null))
            ->add('fecha','date')
//             ->add('alumno','entity',array('class' => 'UserBundle:Alumno',
//                                 'required' => true,
//                                 'empty_value' => 'Seleccione una opción'
//             		))
            ->add('descripcion','textarea')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Edukagames\AdminBundle\Entity\Informe'
        ));
    }

    public function getName()
    {
        return 'edukagames_adminbundle_informetype';
    }
}
