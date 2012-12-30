<?php

namespace Edukagames\AdminBundle\Entity;

use Symfony\Component\Validator\Constraints\Date;

use Doctrine\Common\Annotations\Annotation\Target;

use Doctrine\ORM\Mapping as ORM;

/**
 * Edukagames\AdminBundle\Entity\Archivo
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Archivo
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;



    /**
     * @var string $Archivo
     *
     * @ORM\Column(name="nombreArchivo", type="string", length=255)
     */
    private $Archivo;

    /**
     * @var \DateTime $fecha
     *
     * @ORM\Column(name="fecha", type="datetime")
     */
    private $fecha;

    /**
     * @var string $informe
     * 
     * @ORM\Column(name="informe", type="string", length=255)
     */
    private $informe;
    
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
    public function getId()
    {
        return $this->id;
    }

    public function setArchivo($Archivo)
    {
        $this->nombreArchivo = $nombreArchivo;

        return $this;
    }

    /**
     * Get NombreArchivo
     *
     * @return string 
     */
    public function getArchivo()
    {
        return $this->nombreArchivo;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return Archivos
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    
        return $this;
    }

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
    }
    
    /**
     * Set fecha
     *
     * @param Date $fecha
     * @return Archivos
     */
    public function setFecha($fecha)
    {
    	$this->fecha = $fecha;
    
    	return $this;
    }
    
    /**
     * Get fecha
     *
     * @return Date
     */
    public function getFecha()
    {
    	return $this->fecha;
    }
    
    public function getInforme()
    {
    	return $this->informe;
    }
    
    public function setInforme($informe)
    {
    	$this->informe = $informe;
    }
}
