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
	 * @param int $i
	 * @param $email
	 * @param array $attributesArray
	 * @return $this
	 */
	public function addPayload($i=0, $email, array $attributesArray)
	{
		$this->payload['user_attributes_array'][$i]['target']['email'] = $email;
		foreach ($attributesArray as $k=>$v) {
			$this->payload['user_attributes_array'][$i]['attributes'][$k] = $v;
		}

		return $this;
	}

}