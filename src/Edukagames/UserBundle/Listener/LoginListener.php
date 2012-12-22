<?php
namespace Edukagames\UserBundle\Listener;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Routing\Router;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Edukagames\UserBundle\Entity;

Class LoginListener{
	
	private $id = null;
	private $router;
	
	public function __construct(Router $router){
		$this->router = $router;
	}
	
	public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
	{
		$token = $event->getAuthenticationToken()->getUser();
		$this->id = $token->getId();

		
	}
	public function onKernelResponse(FilterResponseEvent $event)
	{
		if (null != $this->id) {
			$portada = $this->router->generate('index', array(
						'id' => $this->id
						));
			$event->setResponse(new RedirectResponse($portada));
		}
	}
		
	
}