<?php

namespace Edukagames\UserBundle\Controller;

use Edukagames\UserBundle\Entity\Alumno;

use Edukagames\UserBundle\Form\AlumnoPerfilType;

use Symfony\Component\Security\Core\SecurityContext;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('UserBundle:Base:index.html.twig');
    }
    
    public function loginAction() {
        $request = $this->getRequest();
        $session = $request->getSession();

		if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
			$error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
		} else {
			$error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
		}
			
		return $this->render('UserBundle:Base:loginBox.html.twig',array(
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
    	
    	if ($this->getRequest()->getMethod() == "POST") {
    		$formulario->bindRequest($this->getRequest());
    		if ($formulario->isValid()) {
    			$em = $this->getDoctrine()->getEntityManager();
    			$alumno = $this->getDoctrine()->getEntityManager()->getRepository('UserBundle:Alumno')->find($userConnected->getId());
    			$passwordNoEncriptado = $formulario->getData()->getPassword();
    			$newUser = $formulario->getData()->getUserName();
    			if ($passwordNoEncriptado != null) {
    				$encoder = $this->get('security.encoder_factory')->getEncoder($alumno);
	    			$passwordCodificado = $encoder->encodePassword($passwordNoEncriptado, $alumno->getSalt());
	    			$alumno->setPassword($passwordCodificado);
    				$alumno->setUserName($newUser);
    			} else {
    				$alumno->setUserName($newUser);
    			}
    			
    			$em->persist($alumno);
    			$em->flush($alumno);
    			
     			return $this->redirect($this->generateUrl('user_perfil_edit'));

    		}
    		
    	}

    	return $this->render('UserBundle:Default:perfil.html.twig', array(
    			'form' => $formulario->createView(),
    			'user' => $userConnected
    	));
    	
    }
}
