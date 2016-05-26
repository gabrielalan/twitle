<?php

namespace Twitle\Config;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twitle\Response\Json;

class Middlewares {

	public static function provideMiddlewares(Application $app) {
		$app->before(self::createAcceptJsonBodyMiddleware());
		$app->after(self::createFriendlyJsonMiddleware());
	}

	public static function createFriendlyJsonMiddleware() {
		return function(Request $request, Response $response) {
			$statusCode = $response->getStatusCode();

			$controllerContent = json_decode($response->getContent(), true);

			$error = $statusCode >= 500;

			if ($statusCode === 404 && !$controllerContent) {
				$error = true;
				$controllerContent = ["Sorry, the page you are looking for could not be found."];
			}

			if ($error) {
				$content = new Json([], $controllerContent, false);
			} else {
				$content = new Json($controllerContent);
			}

			$response->setContent(json_encode($content));
		};
	}

	public static function createAcceptJsonBodyMiddleware() {
		return function(Request $request) {
			if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
				$data = json_decode($request->getContent(), true);
				$request->request->replace(is_array($data) ? $data : array());
			}
		};
	}
} 