<?php

namespace Edukagames\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
	/**
	 * routing.yml
	 * name: admin_index
	 * pattern: /admin
	 *
	 * */
    public function indexAction()
    {
        return $this->render('::index.html.twig');
    }
}
