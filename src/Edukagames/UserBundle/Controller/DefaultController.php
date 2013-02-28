<?php

namespace Edukagames\UserBundle\Controller;

use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
	/**
	 * routing.yml
	 * name: user_index
	 * pattern: /usuario
	 *
	 * */
    public function indexAction()
    {
        return $this->render('::index.html.twig');
    }
    
    /**
     * routing.yml
     * name: login
     * pattern: /
     *
     * */
    public function loginAction() {
        $request = $this->getRequest();
        $session = $request->getSession();

		if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
			$error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
		} else {
			$error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
		}
			
		return $this->render('::loginBox.html.twig',array(
				// last username entered by the user
				'last_username' => $session->get(SecurityContext::LAST_USERNAME),
				'error' => $error)
		);
    }
}
