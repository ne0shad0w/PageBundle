<?php

namespace ne0shad0w\PageBundle\PageBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class PageBundle extends Bundle
{
	protected $theme_repertoire = "../src/FrontBundle/Resources/views/Default/";

	public function getTheme() {return $this->theme_repertoire ; }
	public function setTheme($theme) { if ( $theme != "" ) $this->theme_repertoire = $theme ;}
	
	public function load_module(){		
		return array( array("nom"=>"gestionPages" , "route"=>"adm_gestionpage" , "icone"=>"glyphicon-file"),
					  array("nom"=>"gestionCSS" , "route"=>"edit_css" , "icone"=>"glyphicon-edit") 
					 );		
	}
	public function adm_module(){		
		return true;
	}

	public function user_module(){		
		return false;
	}
	
	public function menu_module($lang=""){	
		return $menu = array(
							'titre' => 'GestionSite',
							'menu' => array(
											array('titre'=>'gestionPages', 
												'route' => 'adm_gestionpage',
												'user' => false
												),
											array('titre'=>'gestionCSS', 
												'route' => 'edit_css',
												'user' => false
												),
											array('titre'=>'gestionTemplate', 
												'route' => 'liste_template',
												'user' => false,
												'superadmin' => true
												),
											array('titre' => 'gestionFichier',
												 'route' => 'adm_gestion_fichier',
												 'user' => false ,
												 'superadmin' => true
												 )	
											)
						);
	}
 	public function getParent()
    {
        return 'A2lixI18nDoctrineBundle';
    }
}
