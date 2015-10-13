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
	 * @param $response
	 * @return mixed
	 * @throws \Exception
	 */
	public function handleResponse($response)
	{
		$decoded = json_decode($response);

		if (empty($decoded)) {
			throw new \Exception('Unknown response from Kahuna: '. $decoded);
		}

		$decoded = isset($decoded->success) ? $decoded : $decoded[0];

		if (isset($decoded->success) AND $decoded->success == false) {
			$errorMsg = $decoded->error;
			$errorMsg .= (isset($decoded->error_detail) ? ', '.$decoded->error_detail : '');
			throw new \Exception($errorMsg, $decoded->error_code);
		}

		return $decoded;
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