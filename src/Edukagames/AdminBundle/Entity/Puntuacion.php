<?php

namespace Edukagames\AdminBundle\Entity;

use Symfony\Component\Validator\Constraints\Date;

use Edukagames\UserBundle\Entity\Alumno;

use Edukagames\AdminBundle\AdminBundle;

use Doctrine\ORM\Mapping as ORM;

/**
 * Puntuacion
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Puntuacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Juego
     *
     * @ORM\ManyToOne(targetEntity="Edukagames\AdminBundle\Entity\Juego")
     */
    private $Juego;

    /**
     * @var Alumno
     *
     * @ORM\ManyToOne(targetEntity="Edukagames\UserBundle\Entity\Alumno")
     */
    private $Alumno;

    /**
     * @var float
     *
     * @ORM\Column(name="Puntos", type="float", nullable=true)
     */
    private $Puntos;

    /**
     * @var string $dificultad
     *
     * @ORM\Column(name="Dificultad", type="string", length=255)
     */
    private $Dificultad;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="Aciertos", type="integer", nullable=true)
     */
    private $Aciertos;

    /**
     * @var integer
     *
     * @ORM\Column(name="Fallos", type="integer", nullable=true)
     */
    private $Fallos;
    
    /**
     * @var float
     *
     * @ORM\Column(name="Tiempo", type="float", nullable=true)
     */
    private $Tiempo;
    
    /**
     * @var \Date $fecha
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
     * Set Juego
     *
     * @param string $juego
     * @return Puntuacion
     */
    public function setJuego(\Edukagames\AdminBundle\Entity\Juego $juego)
    {
        $this->Juego = $juego;
    
        return $this;
    }

    /**
     * Get Juego
     *
     * @return string 
     */
    public function getJuego()
    {
        return $this->Juego;
    }

    /**
     * Set Alumno
     *
     * @param string $alumno
     * @return Puntuacion
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
     * Set Dificultad
     *
     * @param float $dificultad
     * @return Puntuacion
     */
    public function setDificultad($dificultad)
    {
    	$this->Dificultad = $dificultad;
    
    	return $this;
    }
    
    /**
     * Get Dificultad
     *
     * @return float
     */
    public function getDificultad()
    {
    	return $this->Dificultad;
    }
    
    /**
     * Set Puntos
     *
     * @param float $puntos
     * @return Puntuacion
     */
    public function setPuntos($puntos)
    {
        $this->Puntos = $puntos;
    
        return $this;
    }

    /**
     * Get Puntos
     *
     * @return float 
     */
    public function getPuntos()
    {
        return $this->Puntos;
    }

    /**
     * Get Aciertos
     *
     * @return integer
     */
    public function getAciertos()
    {
    	return $this->Aciertos;
    }
    
    /**
     * Set Aciertos
     *
     * @param integer $aciertos
     * @return Puntuacion
     */
    public function setAciertos($aciertos)
    {
        $this->Aciertos = $aciertos;
    
        return $this;
    }

    /**
     * Get Fallos
     *
     * @return integer 
     */
    public function getFalloss()
    {
        return $this->Fallos;
    }

    /**
     * Set Fallos
     *
     * @param integer $fallos
     * @return Puntuacion
     */
    public function setFallos($fallos)
    {
    	$this->Fallos = $fallos;
    
    	return $this;
    }
    

    
    /**
     * Set Tiempo
     *
     * @param float $tiempo
     * @return Puntuacion
     */
    public function setTiempo($tiempo)
    {
        $this->Tiempo = $tiempo;
    
        return $this;
    }

    /**
     * Get Tiempo
     *
     * @return Puntuacion 
     */
    public function getTiempo()
    {
        return $this->Tiempo;
    }
    
    /**
     * Set fecha
     *
     * @param Date $fecha
     * @return Puntuacion
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
