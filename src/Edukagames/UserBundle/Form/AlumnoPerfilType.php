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
			->add('password','repeated',array(
				'type' => 'password',
				'invalid_message' => 'Las dos contraseñas deben coincidir',
				'options' => array('label' => 'Contraseña')
			));
					
		

	}
	
	public function getName()
	{
		return "Alumno_Perfil";
	}

}
?>