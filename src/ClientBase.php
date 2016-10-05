<?php

namespace Idealley\CloudCmsSDK;

use App\Token;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Idealley\CloudCmsSDK\Repository\Node;
use Idealley\CloudCmsSDK\Repository\Branch;
use Idealley\CloudCmsSDK\Token\FileTokenStorage as File;
use League\Flysystem\Adapter\Local;
use Symfony\Component\Yaml\Yaml;

class ClientBase extends Auth {


	public function __construct($clientKey, $clientSecret, $username, $password, $redirectUri, $urlResourceOwnerDetails, $deploymentUrl, $repositoryId, $branch, $tokenStoragePath){

       	$this->token = $this->setToken($clientKey, $clientSecret, $username, $password, $redirectUri, $urlResourceOwnerDetails, $tokenStoragePath);
        
        $this->setClient();
		$this->setHeaders();
		$this->baseUrl = $urlResourceOwnerDetails;
		$this->deploymentUrl = $deploymentUrl;
		$this->repositoryId = $repositoryId;
		$this->branch = $branch;
		
	}
	/**
	* Set the Guzzle Client
	*/
	public function setClient(){
		$this->client = new Client();
	}

    public function setHeaders(){
            $this->headers = array('authorization' => 'Bearer '.$this->token);
    }

	public function nodes(){
		return new Node($this->client, $this->headers, $this->baseUrl, $this->deploymentUrl, $this->repositoryId, $this->branch);
	}

	public function branches(){
		return new Branch($this->client, $this->headers, $this->baseUrl, $this->deploymentUrl, $this->repositoryId, $this->branch);
	}

	public function setToken($clientKey, $clientSecret, $username, $password, $redirectUri, $urlResourceOwnerDetails, $tokenStoragePath){
		    $now = new \DateTime('now', new \DateTimeZone('UTC'));
		    $file = new File('token', $tokenStoragePath);
		  
		    if($file->read('token') === null){  	
		    	$this->auth($clientKey, $clientSecret, $username, $password, $redirectUri, $urlResourceOwnerDetails);
		    	$file->write($this->setAccessToken($this->accessToken));
		    	return $this->accessToken->getToken(); 	
		    }
		    if($now->getTimestamp() >= $file->read('expires')){
		    	//Use the refresh token...
		    	$this->auth($clientKey, $clientSecret, $username, $password, $redirectUri, $urlResourceOwnerDetails);
		    	$file->write($this->setAccessToken($this->accessToken));
		    	return  $this->accessToken->getToken();
		    }

		    if($now->getTimestamp() < $file->read('expires')){
		    	return $file->read('token');
		    }

	}

}


