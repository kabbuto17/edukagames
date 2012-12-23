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
     * @var Informes $informe
     *
     * @ORM\ManyToOne (targetEntity="Edukagames\AdminBundle\Entity\Informe")
     */
    private $informe;

    /**
     * @var string $nombreArchivo
     *
     * @ORM\Column(name="nombreArchivo", type="string", length=255)
     */
    private $nombreArchivo;

    /**
     * @var string $salt
     *
     * @ORM\Column(name="salt", type="string", length=255)
     */
    private $salt;

    /**
     * @var string $fecha
     *
     * @ORM\Column(name="fecha", type="date")
     */
    private $fecha;
    
    
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set informe
     *
     * @param integer $informe
     * @return Archivo
     */
    public function setInforme(\Edukagames\AdminBundle\Entity\Informe $informe)
    {
        $this->informe = $informe;
    
        return $this;
    }

    /**
     * Get informe
     *
     * @return integer 
     */
    public function getInforme()
    {
        return $this->informe;
    }

    /**
     * Set rutaInforme
     *
     * @param string $rutaInforme
     * @return Archivos
     */
    public function setRutaInforme($rutaInforme)
    {
        $this->rutaInforme = $rutaInforme;
    
        return $this;
    }

    /**
     * Get rutaInforme
     *
     * @return string 
     */
    public function getRutaInforme()
    {
        return $this->rutaInforme;
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
}