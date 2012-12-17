<?php

namespace Edukagames\AdminBundle\Entity;
use Symfony\Component\Security\Core\User\UserInterface;

use Doctrine\ORM\Mapping as ORM;

/**
 * Edukagames\AdminBundle\Entity\profesor
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Profesor implements UserInterface {
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
	 * @ORM\Column(name="nombre", type="string", length=255)
	 */
	private $nombre;

	/**
	 * @var string $password
	 *
	 * @ORM\Column(name="password", type="string", length=255)
	 */
	private $password;

	/**
	 * @var string $salt
	 *
	 * @ORM\Column(name="salt", type="string", length=255)
	 */
	private $salt;

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
	 * @return profesor
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
	 * Set password
	 *
	 * @param string $password
	 * @return profesor
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
	 * @return profesor
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
	public function getRoles() {
		return Array('ROLE_ADMIN');
	}
	public function getUsername() {
		return $this->nombre;

	}
	public function eraseCredentials() {
		// TODO: Auto-generated method stub

	}

}
