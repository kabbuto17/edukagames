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
     * @var string $rutaXML
     *
     * @ORM\Column(name="rutaXML", type="string", length=255)
     */
    private $rutaXML;

    /**
     * @var string $link
     *
     * @ORM\Column(name="link", type="string", length=255)
     */
    private $link;


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
     * Set rutaXML
     *
     * @param string $rutaXML
     * @return Juego
     */
    public function setRutaXML($rutaXML)
    {
        $this->rutaXML = $rutaXML;
    
        return $this;
    }

    /**
     * Get rutaXML
     *
     * @return string 
     */
    public function getRutaXML()
    {
        return $this->rutaXML;
    }

    /**
     * Set link
     *
     * @param string $link
     * @return Juego
     */
    public function setLink($link)
    {
        $this->link = $link;
    
        return $this;
    }

    /**
     * Get link
     *
     * @return string 
     */
    public function getLink()
    {
        return $this->link;
    }
}
