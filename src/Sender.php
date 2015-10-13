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

		return $request->handleResponse($response);
	}
}