<?php

namespace Tests;

use HQ\Kahuna\Request\EmailSync;
use HQ\Kahuna\RequestFactory;
use Nette;
use Tester;
use Tester\Assert;

$container = require __DIR__ . '/../bootstrap.php';
require __DIR__ . '/../BaseTestCase.php';
/**
 * @author Jakapun Kehachindawat <jakapun.kehachindawat@hotelquickly.com>
 */
class EmailSyncTest extends BaseTestCase
{
	/** @var  \HQ\Kahuna\Manager */
	private $kahunaManager;

	public function setUp()
	{
		$this->kahunaManager = $this->container->getByType('\HQ\Kahuna\Manager');
	}

	public function testEmailSyncSuccessful()
	{
		$response = $this->kahunaManager->send(RequestFactory::EMAIL_SYNC, function (EmailSync $request) {
			$request
				->addPayload('geemney@hotmail.com', EmailSync::REASON_UNSUB)
				->addPayload('xyz@gmail.com', EmailSync::REASON_HARD_BOUNCE)
				->addPayload('abc@hotmail.com', EmailSync::REASON_SPAM);
		});
		Assert::true($response);
	}
}

$test = new EmailSyncTest($container);
$test->run();