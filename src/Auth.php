<?php

namespace Idealley\CloudCmsSDK;

use League\OAuth2\Client\Provider\GenericProvider;

abstract class Auth {
	protected $clientKey;
	protected $clientSecret;
	protected $username;
	protected $password;
    protected $redirectUri;  
    protected $urlResourceOwnerDetails;

	
    function __construct($clientKey, $clientSecret, $username, $password, $redirectUri, $urlResourceOwnerDetails) {

		$this->provider = new GenericProvider([
	        'clientId'                => $clientKey, 
	        'clientSecret'            => $clientSecret, 
	        'urlAuthorize'            => 'https://api.cloudcms.com/oauth/authorize',
	        'urlAccessToken'          => 'https://api.cloudcms.com/oauth/token',
	        'redirectUri'             => $redirectUri,    
	        'urlResourceOwnerDetails' => $urlResourceOwnerDetails
    	]);

        $this->accessToken = $this->provider->getAccessToken(
                'password', [
                    'username' => $username,
                    'password' => $password
                ]);
    }

        private function setAccessToken($username, $password){

        }

    	private function getToken() {
    		return $this->accessToken->getToken();
    	}

    	private function getRefreshToken() {
    		return $this->accessToken->getRefreshToken();
    	}

    	private function getExpires() {
    		return $this->accessToken->getExpires();
    	}

    	private function hasExpired() {
    		return $this->accessToken->hasExpired();
    	}



	
}

