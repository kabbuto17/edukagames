<?php 

namespace Edukagames\UserBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class AlumnoPerfilType extends AbstractType
{
	
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder	
			->add('userName')
			->add('password', 'repeated', 
					array('type' => 'password',
							'required' => false,
							'invalid_message' => 'Las dos contrasenas deben coincidir',
							'first_name' =>"Contrasena",
							'second_name' =>"Repita_contrasena",
							'error_bubbling' => 'true'))
			;
	}
	
	public function getName()
	{
		return "Alumno_Perfil";
	}
	
}
?>