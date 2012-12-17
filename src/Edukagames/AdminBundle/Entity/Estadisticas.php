<?php

namespace Edukagames\AdminBundle\Entity;

use Edukagames\UserBundle\Entity\Alumnos;

use Doctrine\Common\Annotations\Annotation\Target;

use Doctrine\ORM\Mapping as ORM;

/**
 * Edukagames\AdminBundle\Entity\Estadisticas
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Estadisticas
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
     * @var Juegos $juego
     *
     * @ORM\ManyToOne (targetEntity="Edukagames\AdminBundle\Entity\Juegos")
     */
    private $juego;

    /**
     * @var Alumnos $alumno
     *
     * @ORM\ManyToOne (targetEntity="Edukagames\UserBundle\Entity\Alumno")
     */
    private $alumno;

    /**
     * @var \DateTime $tiempo
     *
     * @ORM\Column(name="tiempo", type="time")
     */
    private $tiempo;

    /**
     * @var integer $aciertos
     *
     * @ORM\Column(name="aciertos", type="integer")
     */
    private $aciertos;

    /**
     * @var float $puntos
     *
     * @ORM\Column(name="puntos", type="float")
     */
    private $puntos;


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
     * Set juego
     *
     * @param integer $juego
     * @return Estadisticas
     */
    public function setJuego(\Edukagames\AdminBundle\Entity\Juegos $juego)
    {
        $this->juego = $juego;
    
        return $this;
    }

    /**
     * Get juego
     *
     * @return integer 
     */
    public function getJuego()
    {
        return $this->juego;
    }

    /**
     * Set alumno
     *
     * @param integer $alumno
     * @return Estadisticas
     */
    public function setAlumno(\Edukagames\UserBundle\Entity\Alumnos $alumno)
    {
        $this->alumno = $alumno;
    
        return $this;
    }

    /**
     * Get alumno
     *
     * @return integer 
     */
    public function getAlumno()
    {
        return $this->alumno;
    }

    /**
     * Set tiempo
     *
     * @param \DateTime $tiempo
     * @return Estadisticas
     */
    public function setTiempo($tiempo)
    {
        $this->tiempo = $tiempo;
    
        return $this;
    }

    /**
     * Get tiempo
     *
     * @return \DateTime 
     */
    public function getTiempo()
    {
        return $this->tiempo;
    }

    /**
     * Set aciertos
     *
     * @param integer $aciertos
     * @return Estadisticas
     */
    public function setAciertos($aciertos)
    {
        $this->aciertos = $aciertos;
    
        return $this;
    }

    /**
     * Get aciertos
     *
     * @return integer 
     */
    public function getAciertos()
    {
        return $this->aciertos;
    }

    /**
     * Set puntos
     *
     * @param float $puntos
     * @return Estadisticas
     */
    public function setPuntos($puntos)
    {
        $this->puntos = $puntos;
    
        return $this;
    }

    /**
     * Get puntos
     *
     * @return float 
     */
    public function getPuntos()
    {
        return $this->puntos;
    }
}
