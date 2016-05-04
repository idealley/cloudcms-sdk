<?php

namespace Idealley\CloudCmsSDK;

use Idealley\CloudCmsSDK\Auth;

class ClientBase {

	public $test;

	function __construct($clientKey, $clientSecret, $username, $password, $redirectUri, $urlResourceOwnerDetails){
		$this->auth = new Auth($clientKey, $clientSecret, $username, $password, $redirectUri, $urlResourceOwnerDetails );
	}

 function auth(){

		$test[] = $this->auth->getToken();
		$test[] = $this->auth->getRefreshToken();
		$test[] = $this->auth->getExpires();
		$test[] = $this->auth->hasExpired();

		dd($test);
}		

		//test refresh token
		//implement check on token validity then call auth if needed.




}



