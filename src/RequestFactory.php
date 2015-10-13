<?php

namespace HQ\Kahuna;

/**
 * Class RequestFactory
 *
 * @author Jakapun Kehachindawat <jakapun.kehachindawat@hotelquickly.com>
 */
class RequestFactory {

	// These const are Request Names
	const PUSH = 'Push';
	const USER_ATTRIBUTES = 'UserAttributes';
	const KAHUNA_LOGS = 'KahunaLogs';
	const EMAIL_SYNC = 'EmailSync';

	/**
	 * @param array $kahunaSettings
	 */
	public function __construct(
		array $kahunaSettings
	) {
		$this->apiBaseUrl = $kahunaSettings['apiBaseUrl'];
		$this->authUsername = $kahunaSettings['authUsername'];
		$this->authPassword= $kahunaSettings['authPassword'];
		$this->isSandbox = $kahunaSettings['isSandbox'];
	}

	/**
	 * @param $requestName
	 * @return mixed
	 */
	public function create($requestName)
	{
		$class = __NAMESPACE__ . '\Request\\' . $requestName;
		return new $class(
			$this->apiBaseUrl,
			$this->authUsername,
			$this->authPassword,
			$this->isSandbox
		);
	}
}