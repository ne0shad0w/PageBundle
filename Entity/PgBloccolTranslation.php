<?php
namespace ne0shad0w\PageBundle\PageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class PgBloccolTranslation implements \A2lix\I18nDoctrineBundle\Doctrine\Interfaces\OneLocaleInterface
{
	use \A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;
    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $htmlBloccol;


    public function getId()
    {
        return $this->id;
    }

    public function setHtmlBloccol($htmlBloccol)
    {
        $this->htmlBloccol = $htmlBloccol;
        return $this;
    }

    public function getHtmlBloccol()
    {
        return $this->htmlBloccol;
    }
}