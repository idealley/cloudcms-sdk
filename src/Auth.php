<?php

namespace Ideally\CloudCmsSDK;

use League\OAuth2\Client\Provider\GenericProvider;

abstract class Auth {
	protected $clientKey;
	protected $clientSecret;
	protected $username;
	protected $password;
    protected $redirectUri;  
    protected $urlResourceOwnerDetails;

	function __construct($clientKey, $clientSecret, $username, $password, $redirectUri, $urlResourceOwnerDetails) {
		$this->clientKey = $clientKey;
		$this->clientSecret = $clientSecret;
		$this->username = $username;
		$this->password = $password;
		$this->redirectUri = $redirectUri;

		$this->provider = new GenericProvider([
	        'clientId'                => $clientKey, 
	        'clientSecret'            => $clientSecret, 
	        'urlAuthorize'            => 'https://api.cloudcms.com/oauth/authorize',
	        'urlAccessToken'          => 'https://api.cloudcms.com/oauth/token',
	        'redirectUri'             => $this->redirectUri,    
	        'urlResourceOwnerDetails' => $this->urlResourceOwnerDetails
    	]);


    	function getAccessToken() {
    		$accessToken = $this->provider->getAccessToken(
    			'password', [
    				'username' => $this->username,
    				'password' => $$this->password
    			]);
    		return $this->accessToken;
    	}

    	function getToken() {
    		return $this->accessToken->getToken();
    	}

    	function getRefreshToken() {
    		return $this->accessToken->getRefreshToken();
    	}

    	function getExpires() {
    		return $this->accessToken->getExpires();
    	}

    	function hasExpired() {
    		return $this->accessToken->hasExpired();
    	}



	}
}

