<?php

namespace HQ\Kahuna;

/**
 * Class Exception
 *
 * @author Jakapun Kehachindawat <jakapun.kehachindawat@hotelquickly.com>
 */
class Exception extends \Exception {

	private $messageDetail;

	public function __construct($message, $code, $messageDetail)
	{
		parent::__construct($message, $code);
		$this->messageDetail = $messageDetail;
	}

	public function getMessageDetail()
	{
		return $this->getMessage() .', '. $this->messageDetail;
	}
}