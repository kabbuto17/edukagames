<?php
namespace Edukagames\UserBundle\Listener;

use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Router;
use Edukagames\UserBundle\Entity\Alumno;

class LoginListener 
{
	private $router;
	private $role = null;
	
	public function __construct(Router $router)
	{
		$this->router = $router;
	}
	public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
	{
		$token = $event->getAuthenticationToken()->getUser();
		$this->role = $token->getRoles();
	}
	public function onKernelResponse(FilterResponseEvent $event)
	{
		//ldd($this->role);
		if ($this->role[0] == 'ROLE_USER') {
			$portada = $this->router->generate('user_index');
			$event->setResponse(new RedirectResponse($portada));
		}else if($this->role[0] == 'ROLE_ADMIN'){
			$portada = $this->router->generate('admin_index');
			$event->setResponse(new RedirectResponse($portada));
		}
	}
	
	
}
