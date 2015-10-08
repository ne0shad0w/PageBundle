<?php

namespace ne0shad0w\PageBundle\PageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * PgTemplate
 *
 * @ORM\Table(name="pg_template")
 * @ORM\Entity
 */
class PgTemplate
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
     * @var ArrayCollection $page
     *
     * @ORM\OneToMany(targetEntity="PgPage", mappedBy="template", cascade={"persist", "remove", "merge"})
     */
    protected $page;
	
	
 	public function __construct() {
        $this->page = new ArrayCollection();
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
     * Add page
     *
     * @param \ne0shad0w\PageBundle\PageBundle\Entity\PgPage $page
     * @return PgTemplate
     */
    public function addPage(\ne0shad0w\PageBundle\PageBundle\Entity\PgPage $page)
    {
        $this->page[] = $page;
    
        return $this;
    }

    /**
     * Remove page
     *
     * @param \\ne0shad0w\PageBundle\PageBundle\Entity\PgPage $page
     */
    public function removePage(\ne0shad0w\PageBundle\PageBundle\Entity\PgPage $page)
    {
        $this->page->removeElement($page);
    }

    /**
     * Get page
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPage()
    {
        return $this->page;
    }
	
	public function jsonSerialize()
    {
		$data=array();
			
        return array(
            'id' => $this->idTemplate ,
            'nomtemplate'=> $this->nomTemplate ,
			'fichiertemplate' => $this->infoTemplate
        );
    }

}
