<?php

namespace Idealley\CloudCmsSDK;

class ClientBase extends Auth {

	public $test;

	function __construct($clientKey, $clientSecret, $username, $password, $redirectUri, $urlResourceOwnerDetails){
		
		parent::__construct($clientKey, $clientSecret, $username, $password, $redirectUri, $urlResourceOwnerDetails);
		
	}

 function auth(){

		$test['Token'] = $this->accessToken->getToken();
		$test['Refresh Token'] = $this->accessToken->getRefreshToken();
		$test['Expires'] = $this->accessToken->getExpires();
		$test['Has expired'] = $this->accessToken->hasExpired();

		dd($test);
}		

		//test refresh token
		//implement check on token validity then call auth if needed.




}



