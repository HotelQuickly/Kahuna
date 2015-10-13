<?php

namespace Tests;

use HQ\Kahuna\Request\UserAttributes;
use HQ\Kahuna\RequestFactory;
use Nette;
use Tester;
use Tester\Assert;

$container = require __DIR__ . '/../bootstrap.php';
require __DIR__ . '/../BaseTestCase.php';
/**
 * @author Jakapun Kehachindawat <jakapun.kehachindawat@hotelquickly.com>
 */
class UserAttributesTest extends BaseTestCase
{
	/** @var  \HQ\Kahuna\Manager */
	private $kahunaManager;

	public function setUp()
	{
		$this->kahunaManager = $this->container->getByType('\HQ\Kahuna\Manager');
	}

	public function testUpdateUserAttributes()
	{
		$response = $this->kahunaManager->send(RequestFactory::USER_ATTRIBUTES, function(UserAttributes $request) {
			$request
			->addPayload(
				'geemney@hotmail.com',
				array('hobby'=>'Watch movies')
			)->addPayload(
				'byte.yoyoya@gmail.com',
				array('booking_cnt'=>'5', 'hobby'=>'Read books')
			);
		});
		Assert::true($response->success);
	}
}

$test = new UserAttributesTest($container);
$test->run();