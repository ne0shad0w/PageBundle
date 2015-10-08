<?php

namespace ne0shad0w\PageBundle\PageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\Request;

class CssController extends Controller
{
	protected $dir = "./editeCSS" ;
	protected $files = "custom.css" ;

    public function EditerAction()
    {
		$content = "";
		
		if (!is_dir( $this->dir)) {
			mkdir($this->dir , 0777); 
		}
		if ( !file_exists($this->dir . "/" . $this->files) ) {
			$monfichier = fopen($this->dir."/" . $this->files, 'w');
			fseek($monfichier, 0);
			fputs($monfichier, "");			
			fclose($monfichier);
		}

		if ( file_exists($this->dir . "/" . $this->files) )
			$content = file_get_contents($this->dir."/" . $this->files, FILE_USE_INCLUDE_PATH) ;	
        return $this->render('PageBundle:Security:edit_css.html.twig',array('code'=> $content ));

    }
	
    public function EnregistrementAction( Request $request)
    {
			$code = $request->request->get('code');

			$monfichier = fopen($this->dir."/" . $this->files, 'w');
			fseek($monfichier, 0);
			fputs($monfichier, $code);			
			fclose($monfichier);
			return new Response('ok');
    }


}
