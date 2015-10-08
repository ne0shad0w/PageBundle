<?php

namespace ne0shad0w\PageBundle\PageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * PgBlocrow
 *
 * @ORM\Table(name="pg_blocrow")
 * @ORM\Entity
 */
class PgBlocrow
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_blocrow", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idBlocrow;
	


    /**
     * @var string
     *
     * @ORM\Column(name="nom_blocrow", type="string", length=50, nullable=false)
     */
    protected $nomBlocrow;

    /**
     * @var string
     *
     * @ORM\Column(name="class_blocrow", type="string", length=500, nullable=true)
     */
    protected $classBlocrow;

    /**
     * @var string
     *
     * @ORM\Column(name="style_blocrow", type="string", length=500, nullable=true)
     */
    protected $styleBlocrow;

    /**
     * @var integer
     *
     * @ORM\Column(name="position_blocrow", type="smallint", nullable=true)
     */
    protected $positionBlocrow = '0';


	/**
     * @var PgPage $page
     *
     * @ORM\ManyToOne(targetEntity="PgPage", inversedBy="blocrow", cascade={"persist", "merge"}, fetch="EAGER")
     
     *  @ORM\JoinColumn(name="idPage", referencedColumnName="id_page")
     
     */
    private $page;
	
	
	
	/**
     * @var ArrayCollection $bloccol
     *
     * @ORM\OneToMany(targetEntity="PgBloccol", mappedBy="section", cascade={"persist", "remove", "merge"} , fetch="EAGER")
	 * @ORM\OrderBy({ "positionBloccol" = "ASC" })
     */
    private $bloccol;


 	public function __construct() {
        $this->bloccol = new ArrayCollection();
    }
 

    /**
     * Set idBlocrow
     *
     * @param integer $idBlocrow
     * @return PgBlocrow
     */
    public function setIdBlocrow($idBlocrow)
    {
        $this->idBlocrow = $idBlocrow;
    
        return $this;
    }

    /**
     * Get idBlocrow
     *
     * @return integer 
     */
    public function getIdBlocrow()
    {
        return $this->idBlocrow;
    }

    /**
     * Set nomBlocrow
     *
     * @param string $nomBlocrow
     * @return PgBlocrow
     */
    public function setNomBlocrow($nomBlocrow)
    {
        $this->nomBlocrow = $nomBlocrow;
    
        return $this;
    }

    /**
     * Get nomBlocrow
     *
     * @return string 
     */
    public function getNomBlocrow()
    {
        return $this->nomBlocrow;
    }

    /**
     * Set classBlocrow
     *
     * @param string $classBlocrow
     * @return PgBlocrow
     */
    public function setClassBlocrow($classBlocrow)
    {
        $this->classBlocrow = $classBlocrow;
    
        return $this;
    }

    /**
     * Get classBlocrow
     *
     * @return string 
     */
    public function getClassBlocrow()
    {
        return $this->classBlocrow;
    }

    /**
     * Set styleBlocrow
     *
     * @param string $styleBlocrow
     * @return PgBlocrow
     */
    public function setStyleBlocrow($styleBlocrow)
    {
        $this->styleBlocrow = $styleBlocrow;
    
        return $this;
    }

    /**
     * Get styleBlocrow
     *
     * @return string 
     */
    public function getStyleBlocrow()
    {
        return $this->styleBlocrow;
    }

    /**
     * Set positionBlocrow
     *
     * @param integer $positionBlocrow
     * @return PgBlocrow
     */
    public function setPositionBlocrow($positionBlocrow)
    {
        $this->positionBlocrow = $positionBlocrow;
    
        return $this;
    }

    /**
     * Get positionBlocrow
     *
     * @return integer 
     */
    public function getPositionBlocrow()
    {
        return $this->positionBlocrow;
    }

    /**
     * Set page
     *
     * @param \ne0shad0w\PageBundle\PageBundle\Entity\PgPage $page
     * @return PgBlocrow
     */
    public function setPage(\ne0shad0w\PageBundle\PageBundle\Entity\PgPage $page = null)
    {
        $this->page = $page;
    
        return $this;
    }

    /**
     * Get page
     *
     * @return \ne0shad0w\PageBundle\PageBundle\Entity\PgPage 
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Add bloccol
     *
     * @param \ne0shad0w\PageBundle\PageBundle\Entity\PgBloccol $bloccol
     * @return PgBlocrow
     */
    public function addBloccol(\ne0shad0w\PageBundle\PageBundle\Entity\PgBloccol $bloccol)
    {
        $this->bloccol[] = $bloccol;
    
        return $this;
    }

    /**
     * Remove bloccol
     *
     * @param \ne0shad0w\PageBundle\PageBundle\Entity\PgBloccol $bloccol
     */
    public function removeBloccol(\ne0shad0w\PageBundle\PageBundle\Entity\PgBloccol $bloccol)
    {
        $this->bloccol->removeElement($bloccol);
    }

    /**
     * Get bloccol
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBloccol()
    {
        return $this->bloccol;
    }
}
