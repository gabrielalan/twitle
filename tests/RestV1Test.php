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

	private function makeEntryRequest($method, $data = null) {
		$client = $this->createClient();

		$client->request($method, '/rest/v1/', [], [], ['CONTENT_TYPE' => 'application/json'], $data);

		return $client;
	}

	public function testRestSaveEntryWithLongValue()
	{
		$data = '{"text":"Test with long text. Test with long text. Test with long text. Test with long text. Test with long text. Test with long text. Test with long text."}';

		$client = $this->makeEntryRequest('POST', $data);

		$this->assertTrue($client->getResponse()->isServerError());
		$this->assertJson($client->getResponse()->getContent());

		$jsonDecoded = json_decode($client->getResponse()->getContent(), true);

		$this->assertArrayHasKey('result', $jsonDecoded);
		$this->assertArrayHasKey('success', $jsonDecoded);
		$this->assertArrayHasKey('errors', $jsonDecoded);

		$this->assertFalse($jsonDecoded['success']);
		$this->assertEquals(1, count($jsonDecoded['errors']));

		$this->assertEquals('This value is too long. It should have 140 characters or less.', $jsonDecoded['errors'][0]['text']);
	}

	public function testRestSaveEntryWithShortValue()
	{
		$data = '{"text":"no"}';

		$client = $this->makeEntryRequest('POST', $data);

		$this->assertTrue($client->getResponse()->isServerError());
		$this->assertJson($client->getResponse()->getContent());

		$jsonDecoded = json_decode($client->getResponse()->getContent(), true);

		$this->assertArrayHasKey('result', $jsonDecoded);
		$this->assertArrayHasKey('success', $jsonDecoded);
		$this->assertArrayHasKey('errors', $jsonDecoded);

		$this->assertFalse($jsonDecoded['success']);
		$this->assertEquals(1, count($jsonDecoded['errors']));

		$this->assertEquals('This value is too short. It should have 5 characters or more.', $jsonDecoded['errors'][0]['text']);
	}

	public function testRestSaveEntryOk()
	{
		$data = '{"text":"Test with correct value"}';

		$client = $this->makeEntryRequest('POST', $data);

		$this->assertTrue($client->getResponse()->isOk());
		$this->assertJson($client->getResponse()->getContent());

		$jsonDecoded = json_decode($client->getResponse()->getContent(), true);

		$this->assertArrayHasKey('result', $jsonDecoded);
		$this->assertArrayHasKey('success', $jsonDecoded);
		$this->assertArrayHasKey('errors', $jsonDecoded);

		$this->assertTrue($jsonDecoded['success']);
		$this->assertEquals(0, count($jsonDecoded['errors']));
	}

	public function testRestGetAllEntries()
	{
		$client = $this->makeEntryRequest('GET');

		$this->assertTrue($client->getResponse()->isOk());
		$this->assertJson($client->getResponse()->getContent());

		$jsonDecoded = json_decode($client->getResponse()->getContent(), true);

		$this->assertArrayHasKey('result', $jsonDecoded);
		$this->assertArrayHasKey('success', $jsonDecoded);
		$this->assertArrayHasKey('errors', $jsonDecoded);

		$this->assertTrue($jsonDecoded['success']);
		$this->assertEquals(0, count($jsonDecoded['errors']));
	}
}
