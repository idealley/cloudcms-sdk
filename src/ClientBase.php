<?php

namespace Ideally\CloudCmsSDK;

class ClientBase extends Auth{

	public $test;

	function __construct() {

		$test[] = $this->getToken();
		$test[] = $this->getRefreshToken();
		$test[] = $this->getExpires();
		$test[] = $this->hasExpired();

		dd($test);
	}



}



