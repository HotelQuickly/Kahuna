<?php

namespace HQ\Kahuna\Request;

/**
 * Class Request
 *
 * @author Jakapun Kehachindawat <jakapun.kehachindawat@hotelquickly.com>
 */
abstract class Request {

	/** @var string  */
	protected $url;

	/** @var string  */
	protected $payload;

	/**
	 * @return string
	 */
	public function getUrl()
	{
		return $this->url;
	}

	/**
	 * @return string
	 */
	public function getPayload()
	{
		return $this->payload;
	}

}