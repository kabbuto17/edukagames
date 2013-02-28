<?php

namespace Edukagames\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArchivoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombreArchivo','file')
            ->add('fecha','date')
            ->add('informe')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Edukagames\AdminBundle\Entity\Archivo'
        ));
    }

    public function getName()
    {
        return 'edukagames_adminbundle_archivotype';
    }
}
