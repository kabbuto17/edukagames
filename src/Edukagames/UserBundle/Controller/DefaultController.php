<?php

namespace Edukagames\UserBundle\Controller;

use Edukagames\UserBundle\Form\AlumnoPerfilType;

use Symfony\Component\Security\Core\SecurityContext;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('UserBundle:Default:index.html.twig');
    }
    
    public function loginAction() {
        $request = $this->getRequest();
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes
            ->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render('UserBundle:Default:login_template.html.twig',array(
                // last username entered by the user
                'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                'error' => $error)
            );
    }
    public function perfilAction()
    {
    	$token = $this->container->get('security.context')->getToken();
    	$userConnected = $token->getUser();

    	$formulario = $this->createForm(new AlumnoPerfilType(),$userConnected);
		ldd($formulario);
    	return $this->render('UserBundle:Default:perfil.html.twig', array(
    			'form' => $formulario->createView(),
    			'user' => $userConnected
    	));
    	
    }
}
