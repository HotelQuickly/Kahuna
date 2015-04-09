<?php
namespace HQ\Kahuna\Request;

/**
 * Class Push
 *
 * @author Jakapun Kehachindawat <jakapun.kehachindawat@hotelquickly.com>
 */
class Push extends RequestAbstract {

	protected $url = 'push';

	/**
	 * @param $email
	 * @param $message
	 * @return $this
	 */
	public function setPayload($email, $message)
	{
		$this->payload['push_array'][0]['target']['email'] = $email;
		$this->payload['push_array'][0]['notification']['alert'] = $message;

		return $this;
	}

}