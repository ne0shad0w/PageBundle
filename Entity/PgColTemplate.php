<?php

namespace ne0shad0w\PageBundle\PageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * PgColTemplate
 *
 * @ORM\Table(name="pg_coltemplate")
 * @ORM\Entity
 */
class PgColTemplate
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_template", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $idTemplate;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_template", type="string", length=255, nullable=false)
     */
    protected $nomTemplate;

    /**
     * @var string
     *
     * @ORM\Column(name="info_template", type="text", length=65535, nullable=false)
     */
    protected $infoTemplate;
    /**
     * @var string
     *
     * @ORM\Column(name="nom_fichier", type="string", length=255, nullable=false)
     */
    protected $nomFichier;

	/**
     * @var ArrayCollection $colonne
     *
     * @ORM\OneToMany(targetEntity="PgBloccol", mappedBy="template", cascade={"persist", "remove", "merge"})
     */
    protected $colonne;
	
	
 	public function __construct() {
        $this->colonne = new ArrayCollection();
    }


    /**
     * Get idTemplate
     *
     * @return integer 
     */
    public function getIdTemplate()
    {
        return $this->idTemplate;
    }

    /**
     * Set nomTemplate
     *
     * @param string $nomTemplate
     * @return PgTemplate
     */
    public function setNomTemplate($nomTemplate)
    {
        $this->nomTemplate = $nomTemplate;
    
        return $this;
    }

    /**
     * Get nomTemplate
     *
     * @return string 
     */
    public function getNomTemplate()
    {
        return $this->nomTemplate;
    }

    /**
     * Set infoTemplate
     *
     * @param string $infoTemplate
     * @return PgTemplate
     */
    public function setInfoTemplate($infoTemplate)
    {
        $this->infoTemplate = $infoTemplate;
    
        return $this;
    }

    /**
     * Get infoTemplate
     *
     * @return string 
     */
    public function getInfoTemplate()
    {
        return $this->infoTemplate;
    }

    /**
     * Add colonne
     *
     * @param \ne0shad0w\PageBundle\PageBundle\Entity\PgBloccol $colonne
     * @return PgTemplate
     */
    public function addColonne(\ne0shad0w\PageBundle\PageBundle\Entity\Pgbloccol $colonne)
    {
        $this->colonne[] = $colonne;
    
        return $this;
    }

    /**
     * Remove colonne
     *
     * @param \ne0shad0w\PageBundle\PageBundle\Entity\PgBloccol $page
     */
    public function removeColonne(\ne0shad0w\PageBundle\PageBundle\Entity\PgBloccol $colonne)
    {
        $this->colonne->removeElement($colonne);
    }

    /**
     * Get colonne
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getColonne()
    {
        return $this->colonne;
    }

    /**
     * Set nomFichier
     *
     * @param string $nomFichier
     * @return PgColTemplate
     */
    public function setNomFichier($nomFichier)
    {
        $this->nomFichier = $nomFichier;
    
        return $this;
    }

    /**
     * Get nomFichier
     *
     * @return string 
     */
    public function getNomFichier()
    {
        return $this->nomFichier;
    }
}
