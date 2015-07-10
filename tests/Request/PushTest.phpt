<?php

namespace Tests;

use HQ\Kahuna\Request\Push;
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
	/** @var  \HQ\Kahuna\Manager */
	private $kahunaManager;

	public function setUp()
	{
		$this->kahunaManager = $this->container->getByType('\HQ\Kahuna\Manager');
	}

	public function testThrowExceptionWhenUserNotFound()
	{
		Assert::exception(function() {
			$this->kahunaManager->send(RequestFactory::PUSH, function(Push $request) {
				$request->setPayload('987abc_1234_xyz@hotelquickly.com', 'Hello test from BYTE!', ["ticket_id"=>"15"]);
			});
		}, '\Exception');
	}

	public function testSendPushNotificationSuccessful()
	{
		$response = $this->kahunaManager->send(RequestFactory::PUSH, function (Push $request) {
			$request->setPayload('geemney@hotmail.com', 'Hello test from BYTE!', ["ticket_id"=>"15"]);
		});
		Assert::true($response->success);
	}
}

$test = new PushTest($container);
$test->run();