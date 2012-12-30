<?php

namespace Edukagames\UserBundle\Entity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Edukagames\UserBundle\Entity\Alumno
 *
 * @ORM\Table()
 * @ORM\Entity
 * @UniqueEntity(fields= "userName", message="El nombre de usuario ya esta en uso")
 */
class Alumno implements UserInterface {
	/**
	 * @var integer $id
	 *
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @var string $nombre
	 *
	 * @ORM\Column(name="nombre", type="string", length=25)
	 * 
	 * @Assert\NotBlank(message = "El nombre no puede estar vacio")
	 */
	private $nombre;

	/**
	 * @var string $apellidos
	 *
	 * @ORM\Column(name="apellidos", type="string", length=50)
	 * 
	 * @Assert\NotBlank(message = "Los apellidos no pueden estar vacio")
	 * 
	 */
	private $apellidos;

	/**
	 * @var string $password
	 *
	 * @ORM\Column(name="password", type="string", length=255)
	 * 
	 * @Assert\NotBlank()
	 * @Assert\MaxLength(limit = "9", message = "La contraseña debe tener entre 6 y 9 caracteres")
	 * @Assert\MinLength(limit = "6", message = "La contraseña debe tener entre 6 y 9 caracteres")
	 */
	private $password;

	/**
	 * @var string $salt
	 *
	 * @ORM\Column(name="salt", type="string", length=255)
	 */
	private $salt;

	/**
	 * @var string $diagnostico
	 *
	 * @ORM\Column(name="diagnostico", type="string", length=255, nullable=true)
	 */
	private $diagnostico;

	/**
	 * @var string $curso
	 *
	 * @ORM\Column(name="curso", type="string", length=100, nullable=true)
	 */
	private $curso;

	/**
	 * @var \DateTime $fechaNacimiento
	 *
	 * @ORM\Column(name="fechaNacimiento", type="date")
	 */
	private $fechaNacimiento;

	/**
	 * @var string $username
	 * 
	 * @ORM\Column(name="userName", type="string", unique=true)
	 * 
	 * @Assert\NotBlank(message = "El nombre de usuario no puede estar vacio")
	 * @Assert\MaxLength(limit = "9", message = "El nombre de usuario no puede tener mas de 9 letras")
	 * @Assert\MinLength(limit = "3", message = "El nombre de usuario no puede tener menos de 3 letras")
	 */
	private $userName;

	/**
	 * @var string $foto
	 *
	 * @ORM\Column(name="foto", type="string", nullable=true)
	 * 
	 * @Assert\File(
	 *     maxSize = "2048k",
	 *     mimeTypes = {"image/jpeg", "image/jpeg", "image/png"},
	 *     mimeTypesMessage = "Porfavor seleccione un archivo de imagen válido jpg, jpeg o png"
	 * )
	 */
	private $foto;

	/**
	 * Get foto 
	 * 
	 * @return string
	 */
	public function getFoto() {
		return $this->foto;
	}

	/**
	 * Set foto
	 *
	 * @param string $foto
	 * @return alumno
	 */
	public function setFoto($foto) {
		$this->foto = $foto;

		return $this;
	}

	/**
	 * Get id
	 *
	 * @return integer 
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Set nombre
	 *
	 * @param string $nombre
	 * @return alumno
	 */
	public function setNombre($nombre) {
		$this->nombre = $nombre;

		return $this;
	}

	/**
	 * Get nombre
	 *
	 * @return string 
	 */
	public function getNombre() {
		return $this->nombre;
	}

	/**
	 * Set apellidos
	 *
	 * @param string $apellidos
	 * @return alumno
	 */
	public function setApellidos($apellidos) {
		$this->apellidos = $apellidos;

		return $this;
	}

	/**
	 * Get apellidos
	 *
	 * @return string 
	 */
	public function getApellidos() {
		return $this->apellidos;
	}

	/**
	 * Set password
	 *
	 * @param string $password
	 * @return alumno
	 */
	public function setPassword($password) {
		$this->password = $password;

		return $this;
	}

	/**
	 * Get password
	 *
	 * @return string 
	 */
	public function getPassword() {
		return $this->password;
	}

	/**
	 * Set salt
	 *
	 * @param string $salt
	 * @return alumno
	 */
	public function setSalt($salt) {
		$this->salt = $salt;

		return $this;
	}

	/**
	 * Get salt
	 *
	 * @return string 
	 */
	public function getSalt() {
		return $this->salt;
	}

	/**
	 * Set diagnostico
	 *
	 * @param string $diagnostico
	 * @return alumno
	 */
	public function setDiagnostico($diagnostico) {
		$this->diagnostico = $diagnostico;

		return $this;
	}

	/**
	 * Get diagnostico
	 *
	 * @return string 
	 */
	public function getDiagnostico() {
		return $this->diagnostico;
	}

	/**
	 * Set curso
	 *
	 * @param string $curso
	 * @return alumno
	 */
	public function setCurso($curso) {
		$this->curso = $curso;

		return $this;
	}

	/**
	 * Get curso
	 *
	 * @return string 
	 */
	public function getCurso() {
		return $this->curso;
	}

	/**
	 * Set fechaNacimiento
	 *
	 * @param \DateTime $fechaNacimiento
	 * @return alumno
	 */
	public function setFechaNacimiento($fechaNacimiento) {
		$this->fechaNacimiento = $fechaNacimiento;

		return $this;
	}

	/**
	 * Get fechaNacimiento
	 *
	 * @return \DateTime 
	 */
	public function getFechaNacimiento() {
		return $this->fechaNacimiento;
	}

	public function getUsername() {
		return $this->userName;
	}

	public function setUserName($userName) {
		$this->userName = $userName;
		return $this;
	}

	public function getEdad() {
		$fechaActual = date("now");
		$fechaNacimiento = $this->getFechaNacimiento();
		return ($fechaActual - $fechaNacimiento);
	}
	public function getRoles() {
		return Array('ROLE_USER');
	}
	/*
	 * No implement
	 */
	public function eraseCredentials() {
		// TODO: Auto-generated method stub

	}

	public function __toString() {
		return "alumno";
	}

}
