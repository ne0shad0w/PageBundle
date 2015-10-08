<?php

namespace ne0shad0w\PageBundle\PageBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class PageBundle extends Bundle
{
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
												'user' => false
												)
												
											)
						);
	}
 	public function getParent()
    {
        return 'A2lixI18nDoctrineBundle';
    }
}
