<?php

namespace Idealley\CloudCmsSDK\Repository;

class Node extends Repository{
	
    /**
     * Acquires the "child nodes" of this node.  This is done by fetching 
     * all of the nodes that are outgoing-associated to this node with
     * an association of type "a:child".
     *
     * @param  
     * @param  
     * @return 
     */
	public function listChildren($parent){
          $this->method = 'GET';
          $this->request = $this->baseUrl.'/repositories/'.$this->repositoryId.'/branches/'.$this->branch.'/nodes/'.$parent.'/children';
          return $this;
	}

	/**
     * Acquires the relatives of this node. 
     *
     * @param  
     * @param  
     * @return 
     */
	public function listRelatives(){

	}

	/**
     * Queries for relatives of this node.
     *
     * @param  
     * @param  
     * @return 
     */
	public function queryRelatives(){

	}

	/**
     * Retrieves all of the association objects for this node.
     *
     * @param  
     * @param  
     * @return 
     */
	public function associations(){

	}

	/**
     * Traverses around the node and returns any nodes found to be connected.
     *
     * @param  
     * @param  
     * @return 
     */
	public function traverse(){

	}

	/**
     * Finds around a node.
     * 
     * @param  string $payload
     * @return 
     * @todo make the query flexible...
     */
	public function find($payload){

          $query = '{"slug": "'.$payload.'"}';
          $this->method = 'POST';
          $this->request = $this->baseUrl.'/repositories/'.$this->repositoryId.'/branches/'.$this->branch.'/nodes/query';
          $this->payload = $query;
          return $this;

	}

	/**
     * This function brings back an image and allows for manipullation. The url is valid but unsusable in code... 
     * I do not know why yet.
     *
     * @param  
     * @param  
     * @return 
     * @todo maybe we need to move this out
     */
	public function getImage($nodeId){
          $this->imageUrl = $this->deploymentUrl.'preview/node/'.$nodeId;

          return $this;

	}

     /**
     * Get the a feature by its name e.g. f:filename
     *
     * @param string $nodeId 
     * @param string $nodeId
     * @return array
     */
     public function getFeature($nodeId, $featureName){
          $this->method = 'GET';
          $this->request = $this->baseUrl.'/repositories/'.$this->repositoryId.'/branches/'.$this->branch.'/nodes/'.$nodeId.'/features/'.$featureName;

          return $this;
     }
}
