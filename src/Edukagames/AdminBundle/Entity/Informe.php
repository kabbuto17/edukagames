<?php

namespace Edukagames\AdminBundle\Entity;

use Edukagames\UserBundle\Entity\Alumno;

use Symfony\Component\Validator\Constraints\Date;

use Doctrine\Common\Annotations\Annotation\Target;

use Doctrine\ORM\Mapping as ORM;

/**
 * Edukagames\AdminBundle\Entity\Archivo
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Informe
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
     * ej: Informe1.pdf
     *
     * @ORM\Column(name="nombreArchivo", type="string", length=255)
     */
    private $nombreInforme;

    /**
     * @var \Date $fecha
     *
     * @ORM\Column(name="fecha", type="datetime")
     */
    private $fecha;

    /**
     * @var Alumno
     *
     * @ORM\ManyToOne(targetEntity="Edukagames\UserBundle\Entity\Alumno")
     */
    private $Alumno;
    
    /**
     * @var string $descripcion
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=true)
     */
    private $descripcion;
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
     * Set NombreInforme
     *
     * @param string $nombreInforme
     * @return Informe
     */
    public function setNombreInforme($nombreInforme)
    {
        $this->nombreInforme = $nombreInforme;

        return $this;
    }

    /**
     * Get NombreArchivo
     *
     * @return string 
     */
    public function getNombreInforme()
    {
        return $this->nombreInforme;
    }

    /**
     * Set fecha
     *
     * @param Date $fecha
     * @return Informe
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
    
    /**
     * Set Alumno
     *
     * @param entity $alumno
     * @return Informe
     */
    public function setAlumno(\Edukagames\UserBundle\Entity\Alumno $alumno)
    {
    	$this->Alumno = $alumno;
      	return $this;
    }
    
    /**
     * Get Alumno
     *
     * @return string
     */
    public function getAlumno()
    {
    	return $this->Alumno;
    }
    
    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Informe
     */
    public function setDescripcion($descripcion)
    {
    	$this->descripcion = $descripcion;
    	return $this;
    }
    
    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
    	return $this->descripcion;
    }
}
