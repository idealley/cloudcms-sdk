<?php

namespace Idealley\CloudCmsSDK;

use League\OAuth2\Client\Provider\GenericProvider;

abstract class Auth {
    public $token;
    public $headers;
	protected $clientKey;
	protected $clientSecret;
	protected $username;
	protected $password;
    protected $redirectUri;  
    protected $urlResourceOwnerDetails;


        private function setAccessToken($username, $password){

        }

        public function auth($clientKey, $clientSecret, $username, $password, $redirectUri, $urlResourceOwnerDetails){
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

            return $this;
        }

    	public function getToken() {
    		return $this->accessToken->getToken();
    	}

    	public function getRefreshToken() {
    		return $this->accessToken->getRefreshToken();
    	}

    	public function getExpires() {
    		return $this->accessToken->getExpires();
    	}

    	public function hasExpired() {
    		return $this->accessToken->hasExpired();
    	}



	
}

