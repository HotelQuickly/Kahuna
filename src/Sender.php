<?php

namespace HQ\Kahuna;
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
	 * @throws \Exception
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
	 * @throws \Exception
	 */
	private function handleResponse($response)
	{
		$decoded = json_decode($response);

		if (empty($decoded)) {
			throw new \Exception('Unknown response from Kahuna: '. $decoded);
		}

		if (isset($decoded->success) AND $decoded->success == false) {
			$errorMsg = $decoded->error;
			$errorMsg .= (isset($decoded->error_detail) ? ', '.$decoded->error_detail : '');
			throw new \Exception($errorMsg, $decoded->error_code);
		}

		if (isset($decoded[0]->success) AND $decoded[0]->success == false) {
			$errorMsg = $decoded[0]->error;
			$errorMsg .= (isset($decoded[0]->error_detail) ? ', '.$decoded[0]->error_detail : '');
			throw new \Exception($errorMsg, $decoded[0]->error_code);
		}

		return $decoded[0];
	}

}