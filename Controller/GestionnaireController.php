<?php

namespace ne0shad0w\PageBundle\PageBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GestionnaireController extends Controller
{

    public function fichierAction()
    {
        return $this->render('PageBundle:Security:filemanager.html.twig');
    }


}
