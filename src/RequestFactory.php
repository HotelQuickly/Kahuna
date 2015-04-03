<?php

namespace HQ\Kahuna;
use HQ\Kahuna\Request\KahunaLogs;
use HQ\Kahuna\Request\Push;
use HQ\Kahuna\Request\UserAttributes;

/**
 * Class RequestFactory
 *
 * @author Jakapun Kehachindawat <jakapun.kehachindawat@hotelquickly.com>
 */
class RequestFactory extends Core {

	public function createPushRequest()
	{
		return new Push();
	}

	public function createUserAttributesRequest()
	{
		return new UserAttributes();
	}

	public function createKahunaLogsRequest()
	{
		return new KahunaLogs();
	}

}