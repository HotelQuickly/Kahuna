<?php

namespace HQ\Kahuna;
use HQ\Kahuna\Request\Request;

/**
 * Class Core
 *
 * @author Jakapun Kehachindawat <jakapun.kehachindawat@hotelquickly.com>
 */
class Core {

	private $apiBaseUrl;
	private $authUsername;
	private $authPassword;
	private $isSandbox;

	public function __construct(
		$kahunaSettings
	) {
		$this->apiBaseUrl = $kahunaSettings['apiBaseUrl'];
		$this->authUsername = $kahunaSettings['authUsername'];
		$this->authPassword= $kahunaSettings['authPassword'];
		$this->isSandbox = $kahunaSettings['isSandbox'];
	}

	private function getParamEnv()
	{
		$mode = $this->isSandbox ? 's' : 'p';
		return 'env=' . $mode;
	}

	public function makeRequest(Request $request)
	{
		$url = $this->apiBaseUrl. '/' .$request->getUrl(). '?' .$this->getParamEnv();
		$payload = $request->getPayload();

		$header = array(
			'Content-Type:application/json',
			'Authorization: Basic '. base64_encode("{$this->authUsername}:{$this->authPassword}")
		);

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$response = curl_exec($ch);
		curl_close($ch);

		return $this->handleResponse($response);
	}

	private function handleResponse($response)
	{
		$decoded = json_decode($response);

		if (!is_array($decoded) OR empty($decoded)) {
			$exception = new Exception('Unknown response from Kahuna', 901, $decoded);
			throw $exception;
		}

		if ($decoded[0]->success == false) {
			$exception = new Exception($decoded[0]->error, $decoded[0]->error_code, isset($decoded[0]->error_detail) ? $decoded[0]->error_detail : null);
			throw $exception;
		}

		return $decoded[0];
	}

}