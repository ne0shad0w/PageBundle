<?php

namespace ne0shad0w\PageBundle\PageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;

use ne0shad0w\PageBundle\PageBundle\Entity\PageModel;
use ne0shad0w\PageBundle\PageBundle\Entity\SectionModel;
use ne0shad0w\PageBundle\PageBundle\Entity\ColonneModel;

use ne0shad0w\PageBundle\PageBundle\Entity\PgPage;
use ne0shad0w\PageBundle\PageBundle\Entity\PgTemplateBlocrow;
use ne0shad0w\PageBundle\PageBundle\Entity\PgBlocrow;
use ne0shad0w\PageBundle\PageBundle\Entity\PgBloccol;
use ne0shad0w\PageBundle\PageBundle\Form\Type\PgBloccolType;

use A2lix\I18nDoctrineBundle\Annotation\I18nDoctrine;

use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{


    public function GestionPageAction(Request $request)
    {
		$em = $this->getDoctrine()->getManager();
		
		$t = $em->getRepository('PageBundle:PgTemplate')->findAll();
		foreach($t as $tmp) {
			$file = "../src/FrontBundle/Resources/views/Default/" . $tmp->getNomTemplate() . ".html.twig" ;
			if ( file_exists( $file ) ) {
				//$f = fopen($file, 'r');
				clearstatcache();
				if(filesize($file)) {
					$templates[$tmp->getIdTemplate()] = $tmp->getNomTemplate();
				}
				
			}
		}
		$page = new PgPage();
		$p = new PageModel();
		
		
		$form = $this->createFormBuilder($p)
            ->add('nomPage', 'text')
			->add('Template', 'choice' , array('choices'=>$templates , 'required'=>true ) )
			->add('Ajouter', 'submit')
            ->getForm();	
		
		
		$form->handleRequest($request);
		$logger = $this->get('logger');
    	if ($form->isValid()) {
			$template = $em->getRepository('PageBundle:PgTemplate')->find($form->get('Template')->getData());
			//$logger->info('Formulaire :' . $form->get('nomPage')->getData());
			$page->setNomPage($form->get('nomPage')->getData());
			$page->setCanonicalPage( strtolower( str_replace(" ", "" , $form->get('nomPage')->getData() ) ) );
			$page->setTemplate($template );
			$em->persist($page);
			$em->flush();
			
			$p = new PageModel();
			$form = $this->createFormBuilder($p)->add('nomPage', 'text')->add('Template', 'choice' , array('choices'=>$templates , 'required'=>true ) )->add('Ajouter', 'submit')->getForm();	
			
    	} 
		//$logger->error('Une erreur est survenue');
		//$logger->crit('Une erreur est survenue');
		
		$pages = $em->getRepository('PageBundle:PgPage')->findAll();
		$pages = $this->triPage($pages);

        return $this->render('PageBundle:Security:list.html.twig',array('pages'=>$pages , 'form'=> $form->createView() ));

    }
	
	private function triPage($pages){
		$tab = array();		
		$neededObjects = array_filter( $pages,function ($e) {return $e->getPageparent() === NULL;	});
		foreach( $neededObjects as $p ){
			$tab[] = $p ;
			$tab = $this->FindPageEnfant($tab , $p , $pages ) ;
		}
		return $tab ;	
	}
	
	private function FindPageEnfant($tab , $parent, $pages) {
		$neededObjects = array_filter( $pages,function ($e) use ($parent) {return $e->getPageparent() === $parent ;	});
		foreach( $neededObjects as $p ){
			$tab[] = $p ;
			$tab = $this->FindPageEnfant($tab , $p , $pages ) ;
		}
		return $tab;
	}
	public function PageEditAction($id)
    {
		$em = $this->getDoctrine()->getManager();
        return $this->render('PageBundle:Default:index.html.twig');
    }

	public function TemplateEditAction($id , Request $request)
    {
		$em = $this->getDoctrine()->getManager();
		$page = new PgPage();
		$section = new PgBlocrow();
		$p = new SectionModel();
		
		
		$form = $this->createFormBuilder($p)
            ->add('nomSection', 'text')
			->add('Ajouter', 'submit')
            ->getForm();	
		
		$form->handleRequest($request);
		$logger = $this->get('logger');
    	if ($form->isValid()) {
			$page = $em->getRepository('PageBundle:PgPage')->find($id);
			
			$bloc = $page->getBlocrow();			
			$last = count($bloc) - 1;
			if ( $last > 0 ) $max_pos = $bloc[$last]->getPositionBlocrow() + 1;
			else $max_pos = 1 ;
			
			$section->setNomBlocrow($form->get('nomSection')->getData());
			$section->setPage($page );
			$section->setPositionBlocrow($max_pos);
			$em->persist($section);
			$em->flush();
			
			$url = $this->container->get('router')->generate("page_template",array('id'=>$id ));
			return new RedirectResponse($url);		
			
    	} 
		

		$rowtemplate = $em->getRepository('PageBundle:PgRowTemplate')->findAll();

		$pages = $em->getRepository('PageBundle:PgPage')->find($id);
		if ( !$pages ) {
			throw $this->createNotFoundException(
				'No page found for id '.$id
			);
		}
        return $this->render('PageBundle:Security:list.template.page.html.twig',array('template'=>$rowtemplate,'pages'=>$pages , 'form'=> $form->createView()) );
    }
	
	public function ColonneEditAction($id ,$section ,$ligne  , Request $request)
    {
		$em = $this->getDoctrine()->getManager();
		
		$page = new PgPage();
		$c_section = new PgBlocrow();
		$col = new PgBloccol();
		$p = new ColonneModel();
		
		
		$form = $this->createFormBuilder($p)
            ->add('nomColonne', 'text')
			->add('Ajouter', 'submit')
            ->getForm();	
		
		$form->handleRequest($request);
		$logger = $this->get('logger');
    	if ($form->isValid()) {
			$page = $em->getRepository('PageBundle:PgPage')->find($id);
			$bloc = $page->getBlocrow();
			$c_section = $em->getRepository('PageBundle:PgBlocrow')->find( $bloc[$section]->getIdBlocrow() );
			$template_col = $em->getRepository('PageBundle:PgColTemplate')->find( 1 );
			$list_col  = $bloc[$section]->getBloccol();
			$last = count($list_col) - 1;
			if ( $last > 0 ) $max_pos = $list_col[$last]->getPositionBloccol() + 1; else $max_pos = 1 ;
			
			$col->setNomBloccol($form->get('nomColonne')->getData());
			$col->setSection($c_section);
			$col->setTemplate($template_col);
			$col->setPositionBloccol($max_pos);
			$em->persist($col);
			$em->flush();
			
			$url = $this->container->get('router')->generate("page_colonne",array('id'=>$id , 'section'=>$section , 'ligne'=>$ligne ));
			return new RedirectResponse($url);		
			
    	} 
		$em->flush();

		$coltemplate = $em->getRepository('PageBundle:PgColTemplate')->findAll();
		$pages = $em->getRepository('PageBundle:PgPage')->find($id);
		
		if ( !$pages ) {
			throw $this->createNotFoundException(
				'No page found for id '.$id
			);
		}
        return $this->render('PageBundle:Security:list.colonne.html.twig',array('template' => $coltemplate , 'pages'=>$pages,'section'=>$section ,'ligne'=>$ligne, 'form'=> $form->createView()) );
    }

	  /**
     * @Template
	 * @I18nDoctrine
     */
	public function ColonneEditHTMLAction(Request $request,$id,$section,$ligne,$colonne  )
    {
		$html = new PgBloccol();
		$em = $this->getDoctrine()->getManager();
		$pages = $em->getRepository('PageBundle:PgPage')->find($id);
		if ( !$pages ) {
			throw $this->createNotFoundException('No page found for id '.$id);
		}
		
		$html = $em->getRepository('PageBundle:PgBloccol')->findOneByIdBloccol($colonne);
		
		$form = $this->createForm(new PgBloccolType(),$html);

		$form->handleRequest($request);
		if ($request->getMethod() == 'POST') {
			if ( $form->isValid()  ){
				$em = $this->getDoctrine()->getManager();
				$em->persist($html);			
				$em->flush();
				$this->get('session')->getFlashBag()->add('info', $this->get('translator')->trans('Contenu modifier') );
				//$html = new PgBloccol();
				//$form = $this->createForm(new PgBloccolType(),$html);
			}
		} 
		
		$params['form'] = $form->createView();
		//array('pages'=>$pages,'section'=>$section,'ligne'=>$ligne , 'id_col'=> $colonne , 'colonne' => $html->getNomBloccol() , 'html'=>$html->getHtmlBloccol() )
        return $this->render('PageBundle:Security:colonne.HTML.html.twig',$params );
    }
	
	
	
	
	/****************************************************************
								DELETE SECTION
	**************************************************************** */
	public function DeletePageAction($id)
    {
		$em = $this->getDoctrine()->getManager();
		$pages = $em->getRepository('PageBundle:PgPage')->find($id);
		if ( !$pages ) {
			throw $this->createNotFoundException(
				'No page found for id '.$id
			);
		} 
		$em->remove($pages);
		$em->flush();

		$url = $this->container->get('router')->generate("adm_gestionpage");
        return new RedirectResponse($url);		
    }
	
	public function DeleteSectionAction($id )
    {
		$em = $this->getDoctrine()->getManager();
		$section = $em->getRepository('PageBundle:PgBlocrow')->find($id);
		if ( !$section ) {
			throw $this->createNotFoundException(
				'No section found for id '.$id
			);
		} 
		$idpage = $section->getPage()->getIdPage();
		$em->remove($section);
		$em->flush();

		$url = $this->container->get('router')->generate("page_template",array('id'=>$idpage));
        return new RedirectResponse($url);		
    }
	
	public function DeleteColonneAction($id , $section , $ligne )
    {
		$em = $this->getDoctrine()->getManager();
		$col = $em->getRepository('PageBundle:PgBloccol')->find($id);
		if ( !$col ) {
			throw $this->createNotFoundException(
				'No section found for id '.$id
			);
		} 
		$idpage = $col->getSection()->getPage()->getIdPage();
		$em->remove($col);
		$em->flush();

		$url = $this->container->get('router')->generate("page_colonne",array('id'=>$idpage , 'section'=>$section , 'ligne'=>$ligne ));
        return new RedirectResponse($url);		
    }

}
