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
            ->add('fecha', 'date', array(
				    'input'  => 'datetime',
				    'widget' => 'single_text',
            		'format' => 'dd-MM-yyyy',
            		'invalid_message' => 'El formato de la fecha o la fecha no son correctos. DD-MM-AAAA',))
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
