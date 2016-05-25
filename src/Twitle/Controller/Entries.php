<?php
namespace Twitle\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Twitle\Model\Entry;

class Entries
{
	public function getAll(Application $app) {
		try {
			$em = $app['entityManager'];

			$q = $em->createQuery("select u.id, u.text from Twitle\Model\Entry u");
			$entries = $q->getResult();

			return $app->json($entries);
		} catch( \Exception $exception ) {
			return $app->json([$exception->getMessage()], 500);
		}
	}

	public function save(Application $app, Request $request) {
		try {
			$em = $app['entityManager'];

			$entry = new Entry();

			$entry->setText($request->get('text'));

			$errors = $app['validator']->validate($entry);

			if (count($errors) > 0) {
				$messages = [];

				foreach ($errors as $error) {
					$messages[] = [$error->getPropertyPath() => $error->getMessage()];
				}

				return $app->json($messages, 500);
			}

			$em->persist($entry);

			$em->flush();

			return $app->json(['id' => $entry->getId(), 'text' => $entry->getText()]);
		} catch( \Exception $exception ) {
			return $app->json([$exception->getMessage()], 500);
		}
	}
}