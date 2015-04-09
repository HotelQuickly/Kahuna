<?php

namespace HQ\Kahuna\Request;

/**
 * Class RequestAbstract
 *
 * @author Jakapun Kehachindawat <jakapun.kehachindawat@hotelquickly.com>
 */
abstract class RequestAbstract {

	private $apiBaseUrl;
	private $authUsername;
	private $authPassword;
	private $isSandbox;

	/** @var string  */
	protected $url;

	/** @var string  */
	protected $payload;

	public function __construct(
		$apiBaseUrl,
		$authUsername,
		$authPassword,
		$isSandbox
	) {
		$this->apiBaseUrl = $apiBaseUrl;
		$this->authUsername = $authUsername;
		$this->authPassword = $authPassword;
		$this->isSandbox = $isSandbox;
	}

	/**
	 * @return string
	 */
	public function getFullRequestUrl()
	{
		return $this->apiBaseUrl. '/' .$this->url. '?' .$this->getParamEnv();
	}

	/**
	 * @return string
	 */
	public function getPayload()
	{
		return $this->payload;
	}

	/**
	 * @return array
	 */
	public function getHeader()
	{
		return array(
			'Content-Type:application/json',
			'Authorization: Basic '. base64_encode("{$this->authUsername}:{$this->authPassword}")
		);
	}

	/**
	 * @return string
	 */
	private function getParamEnv()
	{
		$mode = $this->isSandbox ? 's' : 'p';
		return 'env=' . $mode;
	}
}