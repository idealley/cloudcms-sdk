<?php

namespace Idealley\CloudCmsSDK;

use App\Token;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Idealley\CloudCmsSDK\Repository\Node;
use Idealley\CloudCmsSDK\Repository\Branch;
use Idealley\CloudCmsSDK\Token\FileTokenStorage as TokenFile;
use Idealley\CloudCmsSDK\Model\FileModelStorage as ModelFile;
use League\Flysystem\Adapter\Local;
use Symfony\Component\Yaml\Yaml;

class ClientBase extends Auth {


	public function __construct($clientKey, $clientSecret, $username, $password, $redirectUri, $urlResourceOwnerDetails, $deploymentUrl, $repositoryId, $branch, $tokenStoragePath){
		$this->tokenStoragePath = $tokenStoragePath;
       	$this->token = $this->setToken($clientKey, $clientSecret, $username, $password, $redirectUri, $urlResourceOwnerDetails);
        
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

	public function setToken($clientKey, $clientSecret, $username, $password, $redirectUri, $urlResourceOwnerDetails){
		    $now = new \DateTime('now', new \DateTimeZone('UTC'));
		    $file = new TokenFile('token', $this->tokenStoragePath);
		  
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

	/**
	* Delete the token.
	*@return null
	*/
	public function unsetToken()
	{
		$file = New TokenFile('token', $this->tokenStoragePath);
		$file->delete();
	}

	/**
	* Save the model locally for faster use
	*/
	public function setModel($qname){
		$file = new ModelFile('model');

		if($file->read('model') === null){  
			$branch = $this->branches();
			$schema['model'] = $branch->getSchema($qname)->get()['properties'];
			$file->write($schema);
			return $file->read();
		}

		if($file->read('model')){  	
		    return $file->read();
		}
	}

	/**
	* If the model changed in CloudCMS allow for deletion
	*/
	public function unsetModel(){
		$file = New ModelFile('model');
		$file->delete();
	}

}


