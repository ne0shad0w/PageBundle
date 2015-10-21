<?php

namespace ne0shad0w\PageBundle\PageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use JMS\DiExtraBundle\Annotation\Inject;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use A2lix\I18nDoctrineBundle\Annotation\I18nDoctrine;

   /**
   * @Security("has_role('ROLE_SUPER_ADMIN')")
   */

class TemplateController extends Controller
{
	protected $dir_theme = "../src/FrontBundle/Resources/views/"  ;
	
	  /**
     * @Route("/admin/page/template/edite/{name}", name = "edit_template" , options={"expose"= true} , defaults={"routeparent" = "liste_template"} )
     * @Template
	 * @I18nDoctrine
     */

    public function EditerAction($name = NULL)
    {
		$content = "";
		if ( $name != NULL ) {
			$em = $this->getDoctrine()->getManager();
			$template = $em->getRepository('PageBundle:PgTemplate')->findByinfoTemplate($name);
			$name .= ".html.twig";
			if ( $template && !file_exists($this->dir_theme . $this->container->getParameter('front_theme') ."/" . $name) ){
					$monfichier = fopen($this->dir_theme . $this->container->getParameter('front_theme') ."/" .$name, 'w');
					fseek($monfichier, 0);
					fputs($monfichier, $code);			
					fclose($monfichier);
			} 
			if ( $template && file_exists($this->dir_theme . $this->container->getParameter('front_theme') ."/" . $name) ){
				$content = file_get_contents($this->dir_theme . $this->container->getParameter('front_theme') ."/".$name, FILE_USE_INCLUDE_PATH) ;
				return $this->render('PageBundle:Security:edit_template.html.twig',array('code'=> $content , 'template'=> $name ));
			}
			
				
		}
		return $this->render('PageBundle:Security:edit_template.html.twig',array('code'=> "" , 'template'=> "" ));

    }

	  /**
     * @Route("/admin/page/template/enregistrer", name = "enregistrer_template"  , defaults={} )
     * @Template
	 * @I18nDoctrine
     */
    public function EnregistrementAction( Request $request)
    {
			$code = $request->request->get('code');
			$template = $request->request->get('template');
			if ( $template == "" || $template == NULL ) die("impossible");
			$dir = $this->dir_theme . $this->container->getParameter('front_theme') ."/";
			$file = $template ;
			if ( file_exists($dir.$file) ) {
				$now = new \Datetime;
				$backup_dir = $dir . $now->format("Y-m-d");
				if (!is_dir( $backup_dir)) {
					mkdir($backup_dir); 
				}
				if ( !copy($dir.$file , $backup_dir . "/" . $now->format("H:i:s") . "_" . $file ) ) die("Copy impossible");
				
				
				$monfichier = fopen($dir.$file, 'w');
				fseek($monfichier, 0);
				fputs($monfichier, $code);			
				fclose($monfichier);
			}
			return new Response('ok');
    }

	  /**
     * @Route("/admin/page/template/liste", name = "liste_template" , defaults={} )
     * @Template
     */
    public function listeAction()
    {
		
		$params = array() ;
		return $this->render('PageBundle:Security:list_template.html.twig', $params);
    }

	  /**
     * @Route("/admin/page/template/liste/data", name = "template_list_data" , options={ "i18n"= false } , defaults={} )
     * @Template
     */
    public function dataAction()
    {
		$em = $this->getDoctrine()->getManager();

		$template = $em->getRepository('PageBundle:PgTemplate')->findAll();
		if ( !$template ) return new Response("");
		foreach( $template as $t)
			$data[] = $t->jsonSerialize();
		
        return new Response(json_encode($data) );
    }

}
