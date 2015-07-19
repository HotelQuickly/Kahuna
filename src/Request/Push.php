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
		// default_config
		$this->payload['default_config']['influence_rate_limiting'] = true;
		$this->payload['default_config']['observe_rate_limiting'] = false;

		// default_params
		if ( count($params) ) {
			$this->payload['default_params'] = $params;
		}

		// push_array
		$this->payload['push_array'][0]['target']['email'] = $email;
		$this->payload['push_array'][0]['notification']['alert'] = $message;

		return $this;
	}

}
