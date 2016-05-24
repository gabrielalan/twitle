<?php

namespace Twitle\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Twitle\Config\Doctrine;

class EntityManagerProvider implements ServiceProviderInterface
{
	public function register(Container $app)
	{
		$app['entityManager'] = function ($name) use ($app) {
			return Doctrine::getEntityManager(realpath(__DIR__ . '/../../../'));
		};
	}
}