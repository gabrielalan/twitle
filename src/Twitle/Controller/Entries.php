<?php
namespace Twitle\Controller;

use Silex\Application;

class Entries
{
	public function getAll(Application $app) {
		$em = $app['entityManager'];

		$q = $em->createQuery("select u from Twitle\Model\Entry u");
    	$entries = $q->getResult();
		
		return $app->json($entries);
	}

	public function save(Application $app) {
		return $app->json(['']);
	}
}