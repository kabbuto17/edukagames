<?php

namespace Edukagames\AdminBundle\Entity;

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
     * @var integer
     *
     * @ORM\Column(name="Nivel", type="integer", nullable=true)
     */
    private $Nivel;

    /**
     * @var integer
     *
     * @ORM\Column(name="Fase", type="integer", nullable=true)
     */
    private $Fase;

    /**
     * @var float
     *
     * @ORM\Column(name="Puntos", type="float", nullable=true)
     */
    private $Puntos;

    /**
     * @var integer
     *
     * @ORM\Column(name="Aciertos", type="integer", nullable=true)
     */
    private $Aciertos;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Tiempo", type="time", nullable=true)
     */
    private $Tiempo;


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
     * Set Nivel
     *
     * @param integer $nivel
     * @return Puntuacion
     */
    public function setNivel($nivel)
    {
        $this->Nivel = $nivel;
    
        return $this;
    }

    /**
     * Get Nivel
     *
     * @return integer 
     */
    public function getNivel()
    {
        return $this->Nivel;
    }

    /**
     * Set Fase
     *
     * @param integer $fase
     * @return Puntuacion
     */
    public function setFase($fase)
    {
        $this->Fase = $fase;
    
        return $this;
    }

    /**
     * Get Fase
     *
     * @return integer 
     */
    public function getFase()
    {
        return $this->Fase;
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
     * Get Aciertos
     *
     * @return integer 
     */
    public function getAciertos()
    {
        return $this->Aciertos;
    }

    /**
     * Set Tiempo
     *
     * @param \DateTime $tiempo
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
     * @return \DateTime 
     */
    public function getTiempo()
    {
        return $this->Tiempo;
    }
}
