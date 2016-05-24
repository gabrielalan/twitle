<?php

namespace Twitle\Config;

use Doctrine\ORM\Tools\Setup,
	Doctrine\ORM\EntityManager,
	Doctrine\Common\EventManager as EventManager,
	Doctrine\ORM\Events,
	Doctrine\ORM\Configuration,
	Doctrine\Common\Cache\ArrayCache as Cache,
	Doctrine\Common\Annotations\AnnotationRegistry, 
	Doctrine\Common\Annotations\AnnotationReader,
	Doctrine\Common\ClassLoader;

class Doctrine {
	
	/**
	 * @return EntityManager
	 */
	public static function getEntityManager($dir) {
		$config = new Configuration();
		$cache = new Cache();
		$config->setQueryCacheImpl($cache);
		$config->setProxyDir('/tmp');
		$config->setProxyNamespace('EntityProxy');
		$config->setAutoGenerateProxyClasses(true);

		AnnotationRegistry::registerFile($dir . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'doctrine' . DIRECTORY_SEPARATOR . 'orm' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'Doctrine' . DIRECTORY_SEPARATOR . 'ORM' . DIRECTORY_SEPARATOR . 'Mapping' . DIRECTORY_SEPARATOR . 'Driver' . DIRECTORY_SEPARATOR . 'DoctrineAnnotations.php');

		$driver = new \Doctrine\ORM\Mapping\Driver\AnnotationDriver(
			new AnnotationReader(),
			array($dir . DIRECTORY_SEPARATOR . 'src')
		);
		$config->setMetadataDriverImpl($driver);
		$config->setMetadataCacheImpl($cache);

		$data = require __DIR__ . '/configuration.php';

		return EntityManager::create(
			$data['db'],
			$config
		);
	}
}