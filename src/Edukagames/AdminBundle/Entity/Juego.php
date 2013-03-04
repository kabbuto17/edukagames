<?php

namespace Edukagames\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Edukagames\AdminBundle\Entity\Juegos
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Juego
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
     * @var string $nombre
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string $descripcion
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @var string $imagen
     *
     * @ORM\Column(name="imagen", type="string", length=255, nullable=true)
     */
    private $imagen;

    /**
     * @var string $XML
     *
     * @ORM\Column(name="XML", type="string", length=255)
     */
    private $XML;
    
    /**
     * @var string $nivel
     *
     * @ORM\Column(name="nivel", type="string", length=255)
     */
    private $nivel;
    
    /**
     * @var string $fase
     *
     * @ORM\Column(name="fase", type="string", length=255)
     */
    private $fase;

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
     * Set nombre
     *
     * @param string $nombre
     * @return Juego
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Juego
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

    /**
     * Set imagen
     *
     * @param string $imagen
     * @return Juego
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    
        return $this;
    }

    /**
     * Get imagen
     *
     * @return string 
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set XML
     *
     * @param string $XML
     * @return Juego
     */
    public function setXML($XML)
    {
        $this->XML = $XML;
    
        return $this;
    }

    /**
     * Get XML
     *
     * @return string 
     */
    public function getXML()
    {
        return $this->XML;
    }
    
    public function getNivel()
    {
    	return $this->nivel;
    }
    
    public function setNivel($nivel)
    {
    	$this->nivel = $nivel;
    }
    
    public function getFase()
    {
    	return $this->fase;
    }
    
    public function setFase($fase)
    {
    	$this->fase= $fase;
    }
}
