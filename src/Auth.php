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


    protected function auth($clientKey, $clientSecret, $username, $password, $redirectUri, $urlResourceOwnerDetails){
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

    protected function setAccessToken($accessToken){
        $array = [
            'token'     => $accessToken->getToken(),
            'expires'   => $accessToken->getExpires()
            ];
        return $array;
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
    /**
    private function getExpires(){
            return $this->accesToken->getExpires();
    }
	*/
}

