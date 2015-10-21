<?php

namespace ne0shad0w\PageBundle\PageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * PgPage
 *
 * @ORM\Table(name="pg_page")
 * @ORM\Entity(repositoryClass="ne0shad0w\PageBundle\PageBundle\Entity\PgPageRepository")
 */
class PgPage
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_page", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $idPage;


    /**
     * @var string
     *
     * @ORM\Column(name="nom_page", type="string", length=255, nullable=false)
     */
    protected $nomPage;
    /**
     * @var string
     *
     * @ORM\Column(name="canonical_page", type="string", length=255, nullable=false)
     */
    protected $canonicalPage;

    /**
     * @var boolean
     *
     * @ORM\Column(name="actif_page", type="boolean", nullable=false)
     */
    protected $actifPage = '0';

	
	/**
     * @var ArrayCollection $blocrow
     *
     * @ORM\OneToMany(targetEntity="PgBlocrow", mappedBy="page", cascade={"persist", "remove", "merge"} , fetch="EAGER")
	 * @ORM\OrderBy({ "positionBlocrow" = "ASC" })
     */
    private $blocrow;
	/**
     * @var PgTemplate $template
     *
     * @ORM\ManyToOne(targetEntity="PgTemplate", inversedBy="page" , fetch="EAGER")
     * @ORM\JoinColumn(name="id_template", referencedColumnName="id_template")
     */
    private $template;

	/**
     * @var PgPage $pageparent
     *
     * @ORM\ManyToOne(targetEntity="PgPage", fetch="EAGER")
     * @ORM\JoinColumn(name="page_parent", referencedColumnName="id_page")
     */
    private $pageparent;


 	public function __construct() {
        $this->blocrow = new ArrayCollection();
    }
    /**
     * Set idPage
     *
     * @param integer $idPage
     * @return PgPage
     */
    public function setIdPage($idPage)
    {
        $this->idPage = $idPage;
    
        return $this;
    }

    /**
     * Get idPage
     *
     * @return integer 
     */
    public function getIdPage()
    {
        return $this->idPage;
    }


    /**
     * Set nomPage
     *
     * @param string $nomPage
     * @return PgPage
     */
    public function setNomPage($nomPage)
    {
        $this->nomPage = $nomPage;
    
        return $this;
    }

    /**
     * Get nomPage
     *
     * @return string 
     */
    public function getNomPage()
    {
        return $this->nomPage;
    }

    /**
     * Set actifPage
     *
     * @param boolean $actifPage
     * @return PgPage
     */
    public function setActifPage($actifPage)
    {
        $this->actifPage = $actifPage;
    
        return $this;
    }

    /**
     * Get actifPage
     *
     * @return boolean 
     */
    public function getActifPage()
    {
        return $this->actifPage;
    }

    /**
     * Add blocrow
     *
     * @param \ne0shad0w\PageBundle\PageBundle\Entity\PgBlocrow $blocrow
     * @return PgPage
     */
    public function addBlocrow(\ne0shad0w\PageBundle\PageBundle\Entity\PgBlocrow $blocrow)
    {
        $this->blocrow[] = $blocrow;
    
        return $this;
    }

    /**
     * Remove blocrow
     *
     * @param \ne0shad0w\PageBundle\PageBundle\Entity\PgBlocrow $blocrow
     */
    public function removeBlocrow(\ne0shad0w\PageBundle\PageBundle\Entity\PgBlocrow $blocrow)
    {
        $this->blocrow->removeElement($blocrow);
    }

    /**
     * Get blocrow
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBlocrow()
    {
        return $this->blocrow;
    }

    /**
     * Set template
     *
     * @param \ne0shad0w\PageBundle\PageBundle\Entity\PgTemplate $template
     * @return PgPage
     */
    public function setTemplate(\ne0shad0w\PageBundle\PageBundle\Entity\PgTemplate $template = null)
    {
        $this->template = $template;
    
        return $this;
    }

    /**
     * Get pageprent
     *
     * @return \ne0shad0w\PageBundle\PageBundle\Entity\PgPage 
     */
    public function getPageparent()
    {
        return $this->pageparent;
    }

    /**
     * Set template
     *
     * @param \ne0shad0w\PageBundle\PageBundle\Entity\PgPage $pageparent
     * @return PgPage
     */
    public function setPageparent(\ne0shad0w\PageBundle\PageBundle\Entity\PgPage $pageparent = null)
    {
        $this->pageparent = $pageparent;
    
        return $this;
    }

    /**
     * Get template
     *
     * @return \ne0shad0w\PageBundle\PageBundle\Entity\PgTemplate 
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Set canonicalPage
     *
     * @param string $canonicalPage
     * @return PgPage
     */
    public function setCanonicalPage($canonicalPage)
    {
        $this->canonicalPage = $canonicalPage;
    
        return $this;
    }

    /**
     * Get caninicalPage
     *
     * @return string 
     */
    public function getCanonicalPage()
    {
        return $this->canonicalPage;
    }

}
