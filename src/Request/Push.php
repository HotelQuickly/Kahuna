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
	 * @param array $params
	 * @return $this
	 */
	public function setPayload($email, $message, $params = array())
	{
		$this->payload['push_array'][0]['target']['email'] = $email;
		$this->payload['push_array'][0]['notification']['alert'] = $message;
		if ( count($params) ) {
			$this->payload['push_array'][0]['params'] = $params;	
		}

		return $this;
	}

}
