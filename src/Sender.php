<?php

namespace HQ\Kahuna;
use HQ\Kahuna\Request\Request;
use HQ\Kahuna\Request\RequestAbstract;

/**
 * Class Sender
 *
 * @author Jakapun Kehachindawat <jakapun.kehachindawat@hotelquickly.com>
 */
class Sender {

	/**
	 * @param RequestAbstract $request
	 * @return mixed
	 * @throws Exception
	 */
	public function send(RequestAbstract $request)
	{
		$url = $request->getFullRequestUrl();
		$payload = $request->getPayload();
		$header = $request->getHeader();

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$response = curl_exec($ch);
		curl_close($ch);

		return $this->handleResponse($response);
	}

	/**
	 * @param $response
	 * @return mixed
	 * @throws Exception
	 */
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