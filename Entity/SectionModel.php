<?php

namespace ne0shad0w\PageBundle\PageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

class SectionModel
{
    protected $nomSection;


	public function setNomSection($nomSection)
    {
        $this->nomSection = $nomSection;
        return $this;
    }

    public function getNomSection()
    {
        return $this->nomSection;
    }


}
