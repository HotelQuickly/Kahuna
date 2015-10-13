<?php
namespace HQ\Kahuna\Request;

/**
 * Class UserAttributes
 *
 * @author Jakapun Kehachindawat <jakapun.kehachindawat@hotelquickly.com>
 */
class UserAttributes extends RequestAbstract {

	protected $url = 'userattributes';

	/**
	 * @param $email
	 * @param array $attributesArray
	 * @return $this
	 */
	public function addPayload($email, array $attributesArray)
	{
		$payload['target']['email'] = $email;
		foreach ($attributesArray as $k=>$v) {
			$payload['attributes'][$k] = $v;
		}

		$this->payload['user_attributes_array'][] = $payload;

		return $this;
	}

}