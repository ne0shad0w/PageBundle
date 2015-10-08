<?php

namespace ne0shad0w\PageBundle\PageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

class PageModel
{
    protected $nomPage;
    protected $canonicalPage;
    private $template;


	public function setNomPage($nomPage)
    {
        $this->nomPage = $nomPage;
   		$this->canonicalPage = str_replace(" ","_",strtolower($nomPage));
        return $this;
    }

    public function getNomPage()
    {
        return $this->nomPage;
    }

	public function setTemplate($template)
    {
        $this->template = $template;
    
        return $this;
    }

    public function getTemplate()
    {
        return $this->template;
    }

}
