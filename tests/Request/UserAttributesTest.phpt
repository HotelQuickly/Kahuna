<?php

namespace Tests;

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
	/** @var  \HQ\Kahuna\RequestFactory */
	private $kahunaRequestFactory;

	public function setUp()
	{
		$this->kahunaRequestFactory = $this->container->getByType('HQ\Kahuna\RequestFactory');
	}

	public function testUpdateUserAttributes()
	{
		$request = $this->kahunaRequestFactory->createUserAttributesRequest()
			->addPayload(
				0,
				'geemney@hotmail.com',
				array('gender'=>'female', 'hobby'=>'Watch movies')
			)
			->addPayload(1,
				'byte.yoyoya@gmail.com',
				array('booking_cnt'=>'5', 'hobby'=>'Read books')
			);
		$response = $this->kahunaRequestFactory->makeRequest($request);
		Assert::true($response->success);
	}
}

$test = new UserAttributesTest($container);
$test->run();