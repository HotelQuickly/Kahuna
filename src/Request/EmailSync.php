<?php
namespace HQ\Kahuna\Request;

/**
 * Class EmailSync
 *
 * @author Jakapun Kehachindawat <jakapun.kehachindawat@hotelquickly.com>
 */
class EmailSync extends RequestAbstract {

	const REASON_UNSUB = 'unsub';
	const REASON_HARD_BOUNCE = 'hard_bounce';
	const REASON_SOFT_BOUNCE = 'soft_bounce';
	const REASON_SPAM = 'spam';
	const REASON_REJECT = 'reject';
	const REASON_INVALID = 'invalid';
	const REASON_BLOCKED = 'blocked';

	protected $url = 'emailsync';

	public function addPayload($email, $reason)
	{
		$payload['reason'] = $reason;
		$payload['email'] = $email;
		$this->payload[] = $payload;

		return $this;
	}

	public function handleResponse($response)
	{
		return true;
	}
}