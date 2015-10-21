<?php

namespace ne0shad0w\PageBundle\PageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use ne0shad0w\PageBundle\PageBundle\Entity\PgPage;
use ne0shad0w\PageBundle\PageBundle\Entity\PgTemplateBlocrow;
use ne0shad0w\PageBundle\PageBundle\Entity\PgBlocrow;
use ne0shad0w\PageBundle\PageBundle\Entity\PgBloccol;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class AjaxController extends Controller
{


    public function UpdateClassBlocRowAction($id  , Request $request)
    {
		$class = $request->request->get('contenu');
		if ( $class == "null" ) $class= "";
		$em = $this->getDoctrine()->getManager();
		if ($request->isXMLHttpRequest()) {   
			$section = $em->getRepository('PageBundle:PgBlocrow')->find($id);
			$section->setClassBlocrow($class);
			if (!$section) {
        		return new Response('error', 400);
    		}			
			$em->flush();
			return new Response('ok');
		}
		
		return new Response('error', 400);
    }
	
    public function UpdateStyleBlocRowAction($id ,  Request $request)
    {
		$class = $request->request->get('contenu');
		if ( $class == "null" ) $class= "";
		$em = $this->getDoctrine()->getManager();
		if ($request->isXMLHttpRequest()) {   
			$section = $em->getRepository('PageBundle:PgBlocrow')->find($id);
			$section->setStyleBlocrow($class);
			if (!$section) {
        		return new Response('error', 400);
    		}			
			$em->flush();
			return new Response('ok');
		}
		
		return new Response('error', 400);
    }
    public function UpdatePositionBlocRowAction($id , Request $request)
    {
		$class = $request->request->get('contenu');
		if ( $class == "null" ) $class= "";
		if ( !is_numeric($class) ) return new Response('non numerique',400);
		$em = $this->getDoctrine()->getManager();
		if ($request->isXMLHttpRequest()) {
			
			$section = $em->getRepository('PageBundle:PgBlocrow')->find($id);   
			$section_p = $em->getRepository('PageBundle:PgBlocrow')->findBy( array( 'positionBlocrow'=> $class , 'page' => $section->getPage() ) );
			if ( !$section_p ) {
				
				$section->setPositionBlocrow($class);
				if (!$section) {
					return new Response('error', 400);
				}			
				$em->flush();
				return new Response('ok');
			} else return new Response('Position', 400);
		}
		
		return new Response('error', 400);
    }
	
    public function UpdateClassBlocColAction($id ,  Request $request)
    {
		$class = $request->request->get('contenu');
		if ( $class == "null" ) $class= "";
		$em = $this->getDoctrine()->getManager();
		if ($request->isXMLHttpRequest()) {   
			$section = $em->getRepository('PageBundle:PgBloccol')->find($id);
			$section->setClassBloccol($class);
			if (!$section) {
        		return new Response('error', 400);
    		}			
			$em->flush();
			return new Response('ok');
		}
		
		return new Response('error', 400);
    }
	
    public function UpdateStyleBlocColAction($id  , Request $request)
    {
		$class = $request->request->get('contenu');
		if ( $class == "null" ) $class= "";
		$em = $this->getDoctrine()->getManager();
		if ($request->isXMLHttpRequest()) {   
			$section = $em->getRepository('PageBundle:PgBloccol')->find($id);
			$section->setLargeurBloccol($class);
			if (!$section) {
        		return new Response('error', 400);
    		}			
			$em->flush();
			return new Response('ok');
		}
		
		return new Response('error', 400);
    }
	
    public function UpdatePositionBlocColAction($id , Request $request)
    {
		$class = $request->request->get('contenu');
		if ( $class == "null" ) $class= "";
		if ( !is_numeric($class) ) return new Response('error',400);
		$em = $this->getDoctrine()->getManager();
		if ($request->isXMLHttpRequest()) {   			
			$section = $em->getRepository('PageBundle:PgBloccol')->find($id);
			$section_p = $em->getRepository('PageBundle:PgBloccol')->findBy( array( 'positionBloccol'=> $class , 'section' => $section->getSection() ) );
			
			//$section_p = $em->getRepository('PageBundle:PgBloccol')->findByPositionBloccol($class);
			if ( !$section_p ) {
				$section->setPositionBloccol($class);
				if (!$section) {
					return new Response('error', 400);
				}			
				$em->flush();
				return new Response('ok');
			} else return new Response('Position', 400);
		}
		
		return new Response('error', 400);
    }
    public function UpdateStyleTemplateBlocColAction($id , Request $request)
    {
		$class = $request->request->get('contenu');
		
		if ( !is_numeric($class) ) return new Response('error',400);
		$em = $this->getDoctrine()->getManager();
		if ($request->isXMLHttpRequest()) {   			
			$section = $em->getRepository('PageBundle:PgBloccol')->find($id);
			if ( $class == 0 ) {
					if (!$section) {
						return new Response('error', 400);
					}
					$section->setTemplate(NULL);			
					$em->flush();
					return new Response('ok');
				
			} else {
				$template = $em->getRepository('PageBundle:PgColTemplate')->find($class);
				if ( $template ) {
					
					if (!$section) {
						return new Response('error', 400);
					}
					$section->setTemplate($template);			
					$em->flush();
					return new Response('ok');
				} else return new Response('template('.$class.')', 400);
			}
		}
		
		return new Response('error', 400);
    }

    public function UpdateHTMLBlocColAction($id , Request $request)
    {
		$html = $request->request->get('html') ;
		
		$em = $this->getDoctrine()->getManager();
		if ($request->isXMLHttpRequest()) {   
				$col = $em->getRepository('PageBundle:PgBloccol')->find($id);
				if (!$col) {
					return new Response('error', 400);
				}
				$col->sethtmlBloccol(stripslashes($html));
			
				$em->flush();
				return new Response('ok');
		}
		
		return new Response('error', 400);
    }
	
    public function ActivePageAction($id ,  Request $request)
    {		
		$em = $this->getDoctrine()->getManager();
		if ($request->isXMLHttpRequest()) {   
				$page = $em->getRepository('PageBundle:PgPage')->find($id);
				if (!$page) {
					return new Response('error', 400);
				}
				if ( $page->getActifPage() ) 
					$page->setActifPage(0);	
				else
					$page->setActifPage(1);		
				$em->flush();
				return new Response($page->getActifPage());
		}
		
		return new Response('error', 400);
    }
	public function UpdateNamePageAction($id , Request $request)
    {
		$contenu = $request->request->get('contenu');
		
		$em = $this->getDoctrine()->getManager();
		if ($request->isXMLHttpRequest()) {   			
			$page = $em->getRepository('PageBundle:PgPage')->find($id);
			if ( $page ) {				
				$page->setnompage($contenu);	
				$page->setCanonicalPage( strtolower( str_replace(" ", "" , $contenu ) ) );		
				$em->flush();
				return new Response('ok');
			} else return new Response('Page('.$contenu.')', 400);
		}
		
		return new Response('error', 400);
    }
	
	/**
     * @Route("/admin/page/parent/update/{id}/{parent}", name = "page_update_parent" , options={ "i18n"= false } , defaults={} )
     * @Template
    */
    public function updateParentAction($id,$parent)
    {
		$em = $this->getDoctrine()->getManager();
		$page = $em->getRepository('PageBundle:PgPage')->find($id);
		if ( $parent > 0 ){
			$pageparent = $em->getRepository('PageBundle:PgPage')->find($parent);
			if ( $id && $parent ) {
				$page->setPageparent($pageparent);
				$em->flush();
				return new Response('ok');
			}
		} else {
			if ( $id ) {
				$page->setPageparent(NULL);
				$em->flush();
				return new Response('ok');
			}
		}	
		
		return new Response("error",400);
	}
	
	/**
     * @Route("/admin/page/row/update/template/{id}", name = "page_update_sect_template" )
     * @Template
    */	
	public function UpdateTemplateBlocRowAction($id , Request $request)
    {
		$class = $request->request->get('contenu');
		
		if ( !is_numeric($class) ) return new Response('error',400);
		$em = $this->getDoctrine()->getManager();
		if ($request->isXMLHttpRequest()) {   			
			$section = $em->getRepository('PageBundle:PgBlocrow')->find($id);
			if ( $class == 0 ) {
					if (!$section) {
						return new Response('error', 400);
					}
					$section->setTemplate(NULL);			
					$em->flush();
					return new Response('ok');
				
			} else {
				$template = $em->getRepository('PageBundle:PgRowTemplate')->find($class);
				if ( $template ) {
					
					if (!$section) {
						return new Response('error', 400);
					}
					$section->setTemplate($template);			
					$em->flush();
					return new Response('ok');
				} else return new Response('template('.$class.')', 400);
			}
		}
		
		return new Response('error', 400);
    }

	
}
