<?php

namespace Tests;

use HQ\Kahuna\RequestFactory;
use HQ\Kahuna\Sender;
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

	/** @var  Sender */
	private $kahunaSender;

	public function setUp()
	{
		$this->kahunaRequestFactory = $this->container->getByType('\HQ\Kahuna\RequestFactory');
		$this->kahunaSender = new Sender();
	}

	public function testThrowExceptionWhenUserNotFound()
	{
		$request = $this->kahunaRequestFactory->create(RequestFactory::PUSH)
			->setPayload('987abc_1234_xyz@hotelquickly.com', 'Hello test from BYTE!');
		Assert::exception(function() use ($request) {
			$this->kahunaSender->send($request);
		}, 'HQ\Kahuna\Exception');
	}

	public function testSendPushNotificationSuccessful()
	{
		$request = $this->kahunaRequestFactory->create(RequestFactory::PUSH)
			->setPayload('geemney@hotmail.com', 'Hello test from BYTE!');
		$response = $this->kahunaSender->send($request);
		Assert::true($response->success);
	}
}

$test = new PushTest($container);
$test->run();