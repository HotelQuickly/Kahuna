<?php

namespace HQ\Kahuna;

/**
 * Class RequestFactory
 *
 * @author Jakapun Kehachindawat <jakapun.kehachindawat@hotelquickly.com>
 */
class RequestFactory extends Core {

	// These const are Request Names
	const PUSH = 'Push';
	const USER_ATTRIBUTES = 'UserAttributes';
	const KAHUNA_LOGS = 'KahunaLogs';

	/**
	 * @param $requestName
	 * @return mixed
	 */
	public function create($requestName)
	{
		$class = __NAMESPACE__ . '\Request\\' . $requestName;
		return new $class();
	}
}