<?php

namespace ne0shad0w\PageBundle\PageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

class ColonneModel
{
    protected $nomColonne;


	public function setnomColonne($nomColonne)
    {
        $this->nomColonne = $nomColonne;
        return $this;
    }

    public function getnomColonne()
    {
        return $this->nomColonne;
    }


}
