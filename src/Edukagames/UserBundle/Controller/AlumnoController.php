<?php

namespace Edukagames\UserBundle\Controller;

use Edukagames\UserBundle\Util\SaveEraseFile;

use Symfony\Component\HttpFoundation\RedirectResponse;

use Symfony\Component\Validator\Constraints\Length;

use Doctrine\ORM\EntityManager;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Edukagames\UserBundle\Util\SaveFile;
use Edukagames\UserBundle\Entity\Alumno;
use Edukagames\UserBundle\Form\AlumnoType;
use Edukagames\UserBundle\Form\SearchType;

/**
 * Alumno controller.
 *
 */
class AlumnoController extends Controller
{
    /**
     * Lists all Alumno entities.
     * 
     * routing/alumno.yml
	 * name: alumno
	 * pattern: /alumno/
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('UserBundle:Alumno')->findAll();
        return $this->render('UserBundle:Alumno:index.html.twig', array(
        		'entities' => $entities,
        		));
    }
    
    /**
     * Displays a form to create a new Alumno entity.
     *
     * routing/alumno.yml
     * name: alumno_new
     * pattern: /alumno/create
     */
    public function newAction()
    {
    	$entity = new Alumno();
    	$form   = $this->createForm(new AlumnoType(), $entity);
    
    	return $this->render('UserBundle:Alumno:new.html.twig', array(
    			'entity' => $entity,
    			'form'   => $form->createView(),
    	));
    }
    
    /**
     * Creates a new Alumno entity.
     *
     */
    public function createAction(Request $request)
    {
    	$entity  = new Alumno();
    	$form = $this->createForm(new AlumnoType(), $entity);
    	$form->bind($request);
    
    	if ($form->isValid()) {
    		$em = $this->getDoctrine()->getManager();
    		$encoder = $this->get('security.encoder_factory')->getEncoder($entity);
    		$entity->setSalt(md5(time()));
    		$passRAW = $entity->getPassword();
    		$passCOD = $encoder->encodePassword($passRAW, $entity->getSalt());
    		$entity->setPassword($passCOD);
    		$entity->setNombreCompleto($entity->getNombre().' '.$entity->getApellidos());
    		$entity->setFoto("defaultprofile.png");
    
    		$em->persist($entity);
    		$em->flush();

    		$this->container->get("session")->setFlash("success", "El alumno se ha creado con exito.");
    		return $this->redirect($this->generateUrl('admin_index'));
//     		return $this->redirect($this->generateUrl('alumno_show', array('id' => $entity->getId())));
    	}
    
    	return $this->render('UserBundle:Alumno:new.html.twig', array(
    			'entity' => $entity,
    			'form'   => $form->createView(),
    	));
    }
    
    /**
     * Finds and displays a Alumno entity.
     *  
     * routing/alumno.yml
	 * name: alumno_show
	 * pattern: /alumno/{id}/show
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('UserBundle:Alumno')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Alumno entity.');
        }
        $deleteForm = $this->createDeleteForm($id);
        return $this->render('UserBundle:Alumno:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        
        	));
    }

    /**
     * Displays a form to edit an existing Alumno entity.
     * 
     * routing/alumno.yml
	 * name: alumno_edit
	 * pattern: /alumno/{id}/edit
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UserBundle:Alumno')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Alumno entity.');
        }

        $editForm = $this->createForm(new AlumnoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UserBundle:Alumno:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Alumno entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UserBundle:Alumno')->find($id);
        $fotoOrin = $entity->getFoto();
        $passOrin = $entity->getPassword();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Alumno entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new AlumnoType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
        	$encoder = $this->get('security.encoder_factory')->getEncoder($entity);
        	$passRAW = $entity->getPassword();
        	$passCOD = $encoder->encodePassword($passRAW, $entity->getSalt());
        	
//         	//si se cambia el nombre o el apellido se actualiza.
//         	if ($editForm->getData()->getNombre() != NULL || $editForm->getData()->getApellidos() != NULL)
//         		$entity->setNombreCompleto($entity->getNombre().' '.$entity->getApellidos());
        	
        	//si el password no se cambia se mantiene.
        	if ($editForm->getData()->getPassword() == NULL)
         		$entity->setPassword($passOrin);
         	else 
         		$entity->setPassword($passCOD);
         	
			//si se cambia la foto se actualiza.	
         	if($editForm->getData()->getFoto() != null){
         		$nombreArchivo = $editForm->getData()->getFoto()->getClientOriginalName();
         		$entity->setFoto($nombreArchivo);
         		$raizImagen = 'uploads/'.$id.'/img/';
          		SaveEraseFile::saveFile($raizImagen, $_FILES['edukagames_userbundle_alumnotype']['tmp_name']["foto"], $nombreArchivo);
           	} else {
          		$entity->setFoto($fotoOrin);
         	}
         	
            $em->persist($entity);
            $em->flush();

            //return $this->redirect($this->generateUrl('alumno_edit', array('id' => $id)));
            $this->container->get("session")->setFlash("Exito!", "El alumno se ha editado con exito.");
            //$url = $this->getRequest()->headers->get("referer");
            return $this->redirect($this->generateUrl('admin_index'));
        }

        return $this->render('UserBundle:Alumno:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Alumno entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UserBundle:Alumno')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Alumno entity.');
            }
            
			SaveEraseFile::eraseDir("/uploads/".$id."/");
            
            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_index'));
        //TODO esto falla por que hace falta un DELETE ON CASCADE..
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    
    /**
     * Busca una lista de alumnos a partir de una cadena dada.
     *
     * routing/alumno.yml
     * name: alumno_search
     * pattern: /alumno/search
     */
    public function searchAction(){
    	
    	$form = $this->createForm(new SearchType());
    	$result ="";
     	if ($this->getRequest()->getMethod() == 'POST') {
    		$form->bindRequest($this->getRequest());
     		if ($form->isValid()) {
		   		$em = $this->getDoctrine()->getEntityManager();
		    	$query = $em->createQuery(
		    			'SELECT alumno FROM UserBundle:Alumno alumno 
		    			WHERE alumno.nombreCompleto
		    			LIKE :search ORDER BY alumno.nombreCompleto ASC')->setParameter('search', '%'.$form["search"]->getData().'%');
		    	$result = $query->getResult();
     		}
     	}
     	($form['search']->getData()== "") ? $result = "" : $result;
    	return $this->render('UserBundle:Alumno:search.html.twig', array(
        		'result' => $result,
        		'form'   => $form->createView(),
        		));	
    }
    /**
     *  Muesta la informacion de un alumno, Datos, Informes, Puntuaciones, etc.
     *  
     *  routing.yml
     *  name: alumno_details
     *  Route: /admin/{id}
     */
    public function AlumnoDetailsAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('UserBundle:Alumno')->find($id);
        if (!$entity) {
        	throw $this->createNotFoundException('Unable to find Alumno entity.');
        }
        return $this->render('UserBundle:Alumno:details.html.twig', array(
                'entity'    => $entity));

    }
}
//TODO editar al guardar cambios hay que mirar a donde redirije, se podria cambiar y poner un flush emergente de que se creo correctamente.
//TODO al crear te manda al view, se podria cambiar y poner un flush emergente de que se creo correctamente.
