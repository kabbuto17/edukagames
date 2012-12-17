<?php

namespace Edukagames\AdminBundle\Entity;

use Edukagames\UserBundle\Entity\Alumnos;

use Doctrine\ORM\Mapping as ORM;

/**
 * Edukagames\AdminBundle\Entity\Informe
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Informes
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
     * @var Alumnos $Alumno
     *
     * @ORM\ManyToOne(targetEntity="Edukagames\UserBundle\Entity\Alumno")
     */
    private $alumno;

    /**
     * @var string $nombreInforme
     *
     * @ORM\Column(name="nombreInforme", type="string", length=255)
     */
    private $nombreInforme;

    /**
     * @var \DateTime $Fecha
     *
     * @ORM\Column(name="fecha", type="datetime")
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
     * Set Alumno
     *
     * @param integer $alumno
     * @return Informe
     */
    public function setAlumno(\Edukagames\UserBundle\Entity\Alumnos $alumno)
    {
        $this->alumno = $alumno;
    
        return $this;
    }

    /**
     * Get Alumno
     *
     * @return integer 
     */
    public function getAlumno()
    {
        return $this->alumno;
    }

    /**
     * Set nombreInforme
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
     * Get nombreInforme
     *
     * @return string 
     */
    public function getNombreInforme()
    {
        return $this->nombreInforme;
    }

    /**
     * Set Fecha
     *
     * @param \DateTime $fecha
     * @return Informe
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    
        return $this;
    }

    /**
     * Get Fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }
}
