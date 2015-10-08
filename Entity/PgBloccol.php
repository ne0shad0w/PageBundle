<?php

namespace ne0shad0w\PageBundle\PageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PgBloccol
 *
 * @ORM\Table(name="pg_bloccol")
 * @ORM\Entity
 */
class PgBloccol
{
	use \A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_bloccol", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idBloccol;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_bloccol", type="string", length=500, nullable=false)
     */
    private $nomBloccol;

    /**
     * @var string
     *
     * @ORM\Column(name="class_bloccol", type="string", length=500, nullable=true)
     */
    private $classBloccol;

    /**
     * @var integer
     *
     * @ORM\Column(name="largeur_bloccol", type="smallint", nullable=true)
     */
    private $largeurBloccol = '12';

    /**
     * @var integer
     *
     * @ORM\Column(name="position_bloccol", type="smallint", nullable=true)
     */
    private $positionBloccol = '0';

	protected $translations;
	/**
     * @var PgBlocrow $section
     *
     * @ORM\ManyToOne(targetEntity="PgBlocrow", inversedBy="bloccol", cascade={"persist", "merge"} , fetch="EAGER")
     * @ORM\JoinColumn(name="idBlocrow", referencedColumnName="id_blocrow")
     */
    private $section;

	/**
     * @var PgColTemplate $template
     *
     * @ORM\ManyToOne(targetEntity="PgColTemplate", inversedBy="colonne" , fetch="EAGER")
     * @ORM\JoinColumn(name="id_template", referencedColumnName="id_template")
     */
    private $template;

	public function __construct()
    {
		$this->translations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set idBloccol
     *
     * @param integer $idBloccol
     * @return PgBloccol
     */
    public function setIdBloccol($idBloccol)
    {
        $this->idBloccol = $idBloccol;
    
        return $this;
    }

    /**
     * Get idBloccol
     *
     * @return integer 
     */
    public function getIdBloccol()
    {
        return $this->idBloccol;
    }


    /**
     * Set nomBloccol
     *
     * @param string $nomBloccol
     * @return PgBloccol
     */
    public function setNomBloccol($nomBloccol)
    {
        $this->nomBloccol = $nomBloccol;
    
        return $this;
    }

    /**
     * Get nomBloccol
     *
     * @return string 
     */
    public function getNomBloccol()
    {
        return $this->nomBloccol;
    }

    /**
     * Set classBloccol
     *
     * @param string $classBloccol
     * @return PgBloccol
     */
    public function setClassBloccol($classBloccol)
    {
        $this->classBloccol = $classBloccol;
    
        return $this;
    }

    /**
     * Get classBloccol
     *
     * @return string 
     */
    public function getClassBloccol()
    {
        return $this->classBloccol;
    }

    /**
     * Set largeurBloccol
     *
     * @param integer $largeurBloccol
     * @return PgBloccol
     */
    public function setLargeurBloccol($largeurBloccol)
    {
        $this->largeurBloccol = $largeurBloccol;
    
        return $this;
    }

    /**
     * Get largeurBloccol
     *
     * @return integer 
     */
    public function getLargeurBloccol()
    {
        return $this->largeurBloccol;
    }

    /**
     * Set positionBloccol
     *
     * @param integer $positionBloccol
     * @return PgBloccol
     */
    public function setPositionBloccol($positionBloccol)
    {
        $this->positionBloccol = $positionBloccol;
    
        return $this;
    }

    /**
     * Get positionBloccol
     *
     * @return integer 
     */
    public function getPositionBloccol()
    {
        return $this->positionBloccol;
    }

    /**
     * Set blocrow
     *
     * @param \ne0shad0w\PageBundle\PageBundle\Entity\PgBlocrow $blocrow
     * @return PgBloccol
     */
    public function setBlocrow(\ne0shad0w\PageBundle\PageBundle\Entity\PgBlocrow $blocrow = null)
    {
        $this->blocrow = $blocrow;
    
        return $this;
    }

    /**
     * Get blocrow
     *
     * @return \ne0shad0w\PageBundle\PageBundle\Entity\PgBlocrow 
     */
    public function getBlocrow()
    {
        return $this->blocrow;
    }

    /**
     * Set section
     *
     * @param \ne0shad0w\PageBundle\PageBundle\Entity\PgBlocrow $section
     * @return PgBloccol
     */
    public function setSection(\ne0shad0w\PageBundle\PageBundle\Entity\PgBlocrow $section = null)
    {
        $this->section = $section;
    
        return $this;
    }

    /**
     * Get section
     *
     * @return \ne0shad0w\PageBundle\PageBundle\Entity\PgBlocrow 
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     * Set template
     *
     * @param \ne0shad0w\PageBundle\PageBundle\Entity\PgColTemplate $template
     * @return PgBloccol
     */
    public function setTemplate(\ne0shad0w\PageBundle\PageBundle\Entity\PgColTemplate $template = null)
    {
        $this->template = $template;
    
        return $this;
    }

    /**
     * Get template
     *
     * @return \ne0shad0w\PageBundle\PageBundle\Entity\PgColTemplate 
     */
    public function getTemplate()
    {
        return $this->template;
    }
}
