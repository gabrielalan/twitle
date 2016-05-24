<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Silex\WebTestCase;

class RestV1Test extends WebTestCase
{
	public function createApplication()
	{
		require __DIR__ . '/../app.php';
		$this->app['session.test'] = true;
		return $app;
	}

	public function testPaginaInicial()
	{
		$client = $this->createClient();
		$crawler = $client->request('GET', '/rest/v1/');
		$this->assertTrue($client->getResponse()->isOk());
		//$this->assertRegExp('/Users/', $client->getResponse()->getContent());
	}
}
