<?php

namespace Idealley\CloudCmsSDK;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Idealley\CloudCmsSDK\Repository\Node;

class ClientBase extends Auth {


	public function __construct($clientKey, $clientSecret, $username, $password, $redirectUri, $urlResourceOwnerDetails, $deploymentUrl, $repositoryId, $branch){
	
        $this->auth($clientKey, $clientSecret, $username, $password, $redirectUri, $urlResourceOwnerDetails);
        $this->client = $this->setClient();
		$this->token = $this->accessToken->getToken();
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



