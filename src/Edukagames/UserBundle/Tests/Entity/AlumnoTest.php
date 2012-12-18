<?php 

namespace Edukagames\UserBundle\Tests\Entity;

use Doctrine\Bundle\DoctrineBundle\Registry;

use Edukagames\UserBundle\Entity\Alumno;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class AlumnoTest extends WebTestCase
{
	/**
	 * @var \Doctrine\ORM\EntityManager
	 */
	private $em;
	
	/**
	 * {@inheritDoc}
	 */
	public function setUp()
	{
		static::$kernel = static::createKernel();
		static::$kernel->boot();
		$this->em = static::$kernel->getContainer()
		->get('doctrine')
		->getEntityManager()
		;
	}
	public function testIndex()
	{
		$alumno = new Alumno();
		$alumno->setApellidos("grillo");
		$alumno->setCurso("1");
		$alumno->setDiagnostico("tdh");
		$alumno->setFechaNacimiento(new \DateTime("now"));
		$alumno->setNombre("pepito");
		$alumno->setPassword("pepitogrillo");
		$alumno->setSalt(md5($alumno->getNombre()));
		$alumno->setUserName("pegri");

		$em = $this->em;
		$em->persist($alumno);
		$em->flush();

		$alumn = $em->getRepository('UserBundle:Alumno')->find(1);
		$this->assertEquals("pepito", $alumn->getNombre());
	}
	
	protected function tearDown()
	{
		parent::tearDown();
		$this->em->close();
	}
	
}
?>