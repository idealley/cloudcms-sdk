<?php

namespace Idealley\CloudCmsSDK\Repository;

class Node{
	
	
    /**
     * Acquires the "child nodes" of this node.  This is done by fetching 
     * all of the nodes that are outgoing-associated to this node with
     * an association of type "a:child".
     *
     * @param  
     * @param  
     * @return 
     */
	public function listChildren(){

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
     * @param  
     * @param  
     * @return 
     */
	public function find(){

	}

	/**
     * 
     *
     * @param  
     * @param  
     * @return 
     * @todo maybe we need to move this out
     */
	public function getFileName(){

	}
}
