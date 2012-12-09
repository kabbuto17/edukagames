<?php

namespace Edukagames\AdminBundle\Entity;

use Doctrine\Common\Annotations\Annotation\Target;

use Doctrine\ORM\Mapping as ORM;

/**
 * Edukagames\AdminBundle\Entity\Archivos
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Archivos
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
     * @ORM\ManyToOne (targetEntity="Edukagames\AdminBundle\Entity\Informes")
     */
    private $informe;

    /**
     * @var string $rutaInforme
     *
     * @ORM\Column(name="rutaInforme", type="string", length=255)
     */
    private $rutaInforme;

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

    /**
     * Set informe
     *
     * @param integer $informe
     * @return Archivos
     */
    public function setInforme(\Edukagames\AdminBundle\Entity\Informes $informe)
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
}
