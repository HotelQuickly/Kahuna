<?php

namespace HQ\Kahuna;

/**
 * Class Manager
 *
 * @author Jakapun Kehachindawat <jakapun.kehachindawat@hotelquickly.com>
 */
class Manager {

	/** @var Sender  */
	private $sender;

	/** @var RequestFactory  */
	private $requestFactory;

	/**
	 * @param RequestFactory $requestFactory
	 */
	public function __construct(
		RequestFactory $requestFactory
	) {
		$this->sender = new Sender();
		$this->requestFactory = $requestFactory;
	}

	/**
	 * @param $requestName
	 * @param \Closure $callback
	 * @return mixed
	 */
	public function send($requestName, \Closure $callback = null)
	{
		$request = $this->requestFactory->create($requestName);

		if ($callback) {
			$callback($request);
		}

		return $response = $this->sender->send($request);
	}

}