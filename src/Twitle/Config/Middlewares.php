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

			if ($statusCode >= 500) {
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