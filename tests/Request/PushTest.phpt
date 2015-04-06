<?php

namespace Tests;

use HQ\Kahuna\RequestFactory;
use Nette;
use Tester;
use Tester\Assert;

$container = require __DIR__ . '/../bootstrap.php';
require __DIR__ . '/../BaseTestCase.php';
/**
 * @author Jakapun Kehachindawat <jakapun.kehachindawat@hotelquickly.com>
 */
class PushTest extends BaseTestCase
{
	/** @var  \HQ\Kahuna\RequestFactory */
	private $kahunaRequestFactory;

	public function setUp()
	{
		$config = $this->container->getParameters();
		$this->kahunaRequestFactory = new RequestFactory($config['kahuna']);
	}

	public function testThrowExceptionWhenUserNotFound()
	{
		$request = $this->kahunaRequestFactory->create(RequestFactory::PUSH)
			->setPayload('987abc_1234_xyz@hotelquickly.com', 'Hello test from BYTE!');
		Assert::exception(function() use ($request) {
			$this->kahunaRequestFactory->makeRequest($request);
		}, 'HQ\Kahuna\Exception');
	}

	public function testSendPushNotificationSuccessful()
	{
		$request = $this->kahunaRequestFactory->create(RequestFactory::PUSH)
			->setPayload('geemney@hotmail.com', 'Hello test from BYTE!');
		$response = $this->kahunaRequestFactory->makeRequest($request);
		Assert::true($response->success);
	}
}

$test = new PushTest($container);
$test->run();