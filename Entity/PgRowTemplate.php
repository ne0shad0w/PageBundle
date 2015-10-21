<?php

namespace ne0shad0w\PageBundle\PageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * PgRowTemplate
 *
 * @ORM\Table(name="pg_rowtemplate")
 * @ORM\Entity
 */
class PgRowTemplate
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
     * @var ArrayCollection $row
     *
     * @ORM\OneToMany(targetEntity="PgBlocrow", mappedBy="template", cascade={"persist", "remove", "merge"})
     */
    protected $row;
	
	
 	public function __construct() {
        $this->row = new ArrayCollection();
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
     * Add row
     *
     * @param \ne0shad0w\PageBundle\PageBundle\Entity\PgBlocrow $row
     * @return PgTemplate
     */
    public function addColonne(\ne0shad0w\PageBundle\PageBundle\Entity\PgBlocrow $row)
    {
        $this->row[] = $row;
    
        return $this;
    }

    /**
     * Remove row
     *
     * @param \ne0shad0w\PageBundle\PageBundle\Entity\PgBlocrow $page
     */
    public function removeColonne(\ne0shad0w\PageBundle\PageBundle\Entity\PgBlocrow $row)
    {
        $this->row->removeElement($row);
    }

    /**
     * Get row
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getColonne()
    {
        return $this->row;
    }

    /**
     * Set nomFichier
     *
     * @param string $nomFichier
     * @return PgRowTemplate
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
