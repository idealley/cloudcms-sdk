<?php

namespace Idealley\CloudCmsSDK;

use App\Token;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Idealley\CloudCmsSDK\Repository\Node;

class ClientBase extends Auth {


	public function __construct($clientKey, $clientSecret, $username, $password, $redirectUri, $urlResourceOwnerDetails, $deploymentUrl, $repositoryId, $branch){
		
		//Get Token from Local Storage
		//$token = Token::find(1);


		//if($this->tokenHasExpired){
        	$this->auth($clientKey, $clientSecret, $username, $password, $redirectUri, $urlResourceOwnerDetails);

        	$this->token = $this->accessToken->getToken();
			$this->refreshToken = $this->accessToken->getRefreshToken();
			$this->refreshToken = $this->accessToken->getExpires();
			$this->tokenHasExpired = $this->accessToken->hasExpired();

			/*Token::find(1)->update([
            	'token' => $this->token,
            	'refresh_token' => $this->refreshToken,
            	'expires_in' => $this->expires_in,
            	'has_expired' => $this->tokenHasExpired
        	]);*/
		//}
        
        $this->client = $this->setClient();
		$this->setHeaders();
		$this->baseUrl = $urlResourceOwnerDetails;
		$this->deploymentUrl = $deploymentUrl;
		$this->repositoryId = $repositoryId;
		$this->branch = $branch;
		
	}

	public function setClient(){
		return $this->client = new Client();
	}

    public function setHeaders(){
            return $this->headers = array('authorization' => 'Bearer '.$this->token);
    }

	public function nodes(){
		return new Node($this->client, $this->headers, $this->baseUrl, $this->deploymentUrl, $this->repositoryId, $this->branch);
	}

		//test refresh token
		//implement check on token validity then call auth if needed.




}



