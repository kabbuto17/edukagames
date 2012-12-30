<?php

namespace Edukagames\AdminBundle\Entity;

use Edukagames\UserBundle\Entity\Alumnos;

use Doctrine\ORM\Mapping as ORM;

/**
 * Edukagames\AdminBundle\Entity\Fichero
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Fichero
{
    /**
     * @var Alumnos $alumno
     *
     * @ORM\ManyToOne(targetEntity="Edukagames\UserBundle\Entity\Alumno")
     */
    private $alumno;

    /**
     * @var Archivo $archivo
     *
     * @ORM\ManyToOne(targetEntity="Edukagames\UserBundle\Entity\Archivo")
     */
    private $archivo;

    /**
     * Set Alumno
     *
     * @param integer $alumno
     * @return Informe
     */
    public function setAlumno(\Edukagames\UserBundle\Entity\Alumno $alumno)
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
    
    public function setArchivo(\Edukagames\UserBundle\Entity\Archivo $achivo)
    {
    	$this->archivo = $archivo;
    
    	return $this;
    }
    
    public function getArchivo()
    {
    	return $this->archivo;
    }

    public function __toString(){
    	return "informe";
    }
}
