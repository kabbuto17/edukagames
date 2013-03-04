<?php

namespace Edukagames\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GraficaType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		//TODO refactorizo juego y tengo k rellenar la mierda esta para ponerla como arrayoptions tu sabeeeee
		foreach($options["data"] as $option){
			$opcionesJuego[] = $option->getNombre();
			$opcionesNivel[] = $option->getNivel();
			
		}
// 		$opcionesJuego[] = 
// 		$opcionesNivel[] =
// 		$opcionesFase[] =
		$builder
		->add('juego','choice')
		->add('nivel','choice')
		->add('fase','choice')
		;
	}

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
// 		$resolver->setDefaults(array(
// 				'data_class' => 'Edukagames\AdminBundle\Entity\Juego'
// 		));
		$resolver->setDefaults(array(
				'data_class' => null
		));
	}

	public function getName()
	{
		return 'edukagames_adminbundle_graficatype';
	}
}
