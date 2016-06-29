<?php

namespace Idealley\CloudCmsSDK\Repository;

class Node extends Repository{
     
    /**
     * Update a document. You need to pass the whole document as you want it to be as a payload 
     * If some properties are misssing, they will be ereased (not the system one)
     * You can add params (examples):
     *     ->addParams(['full' => 'true'])
     *     ->addParams(['inject' => 'true']) This is used to update the document
     *
     * @param  string $parent
     * @return 
     */
     public function updateNode($node, $payload){
          $this->method = 'PUT';
          $this->payload = $payload;
          $this->request = $this->baseUrl.'/repositories/'.$this->repositoryId.'/branches/'.$this->branch.'/nodes/'.$node;
          return $this;
     }
     
    /**
     * Acquires the "child nodes" of this node.  This is done by fetching 
     * all of the nodes that are outgoing-associated to this node with
     * an association of type "a:child".
     * You can add params (examples):
     *     ->addParams(['full' => 'true'])
     *     ->addParams(['sort' => '{"_system.created_on.ms": -1}'])
     * The sorting param is very usefull for a category.
     * @param  string $parent
     * @return 
     */
     public function listChildren($parent){
          $this->method = 'GET';
          $this->request = $this->baseUrl.'/repositories/'.$this->repositoryId.'/branches/'.$this->branch.'/nodes/'.$parent.'/children';
          return $this;
     }

	/**
     * Acquires the relatives of this node. 
     * You can add params (examples):
     *     ->addParams(['full' => 'true'])
     *
     * You HAVE to add the following param
     *     ->addParams(['type' => 'your:type'])           
     *
     * @param  string $node
     * @return 
     */
	public function listRelatives($node){
          $this->method = 'GET';
          $this->request = $this->baseUrl.'/repositories/'.$this->repositoryId.'/branches/'.$this->branch.'/nodes/'.$node.'/relatives';
          return $this;

	}

     /**
     * Queries for relatives of this node. The payload allows to filter down the results here is an example:
     * {"categories": "birthdays"}'
     * You can add params (examples):
     *     ->addParams(['full' => 'true'])
     *
     * You HAVE to add the following param
     *     ->addParams(['type' => 'your:type'])           
     *
     * @param  string $node
     * @param  string $payload
     * @return 
     */
     public function queryRelatives($node,$payload){
          $this->method = 'POST';
          $this->request = $this->baseUrl.'/repositories/'.$this->repositoryId.'/branches/'.$this->branch.'/nodes/'.$node.'/relatives/query';
          $this->payload = $payload;
          return $this;

     }

     /**
     * List INCOMING or OUTGOING relations of this node. Direction must be small caps
     * You can add params (examples):
     *     ->addParams(['full' => 'true'])   
     * You can also specify which relation you would like to get
     *     ->addParams(['type' => 'a:child'])    
     *
     * @param  string $node
     * @param  string $direction
     * @return 
     */
     public function listRelations($node,$direction){
          $this->method = 'GET';
          $this->request = $this->baseUrl.'/repositories/'.$this->repositoryId.'/branches/'.$this->branch.'/nodes/'.$node.'/'.$direction;
          return $this;

     }

     /**
     * Retrieves all of the association objects for this node.
     * You can add params (examples):
     *     ->addParams(['full' => 'true'])   
     * You can also specify which relation you would like to get (it will list incoming or outgoing relations)
     *     ->addParams(['type' => 'a:child'])    
     * You can also specify which direction you would like to get
     *     ->addParams(['direction' => 'OUTGOING'])    
     *
     * @param  string $node
     * @return 
     */
     public function associations($node){
          $this->method = 'GET';
          $this->request = $this->baseUrl.'/repositories/'.$this->repositoryId.'/branches/'.$this->branch.'/nodes/'.$node.'/associations';
          return $this;

     }

     /**
     * List items of an association objects for this node.
     * You can add params (examples):
     *     ->addParams(['full' => 'true'])  
     *     ->addParams(['sort' => '{"_system.created_on.ms": -1}']) 
     *
     * @param  string $node
     * @param  string $association
     * @return 
     */
     public function listAssociationItems($node, $association){
          $this->method = 'GET';
          $this->request = $this->baseUrl.'/repositories/'.$this->repositoryId.'/branches/'.$this->branch.'/nodes/'.$node.'/list/'.$association.'/items';
          return $this;

     }

     /**
     * Query items of an association objects for this node.
     * You can add params (examples):
     *     ->addParams(['full' => 'true'])  
     *     ->addParams(['sort' => '{"_system.created_on.ms": -1}']) 
     *
     * @param  string $node
     * @param  string $association
     * @return 
     */
     public function queryAssociationItems($node, $association, $payload){
          $this->method = 'POST';
          $this->request = $this->baseUrl.'/repositories/'.$this->repositoryId.'/branches/'.$this->branch.'/nodes/'.$node.'/list/'.$association.'/items/query';
          $this->payload = $payload;
          return $this;

     }

	/**
     * Traverses around the node and returns any nodes found to be connected.
     * Example payload:
     *    '{
     *    "associations": {
     *       "a:child": "MUTUAL",
     *       "a:knows": "INCOMING",
     *       "a:related": "OUTGOING"
     *    },
     *    "depth": 1,
     *    "types": [ "custom:type1", "custom:type2" ]
     *    }'
     *  
     * @param  
     * @param  
     * @return 
     */
	public function traverse($node, $payload){
          $payload = '{"traverse":'.$payload.'}';
          $this->method = 'POST';
          $this->request = $this->baseUrl.'/repositories/'.$this->repositoryId.'/branches/'.$this->branch.'/nodes/'.$node.'/traverse'; 
          $this->payload = $payload;
          return $this;
	}

     /**
     * Finds nodes.
     *You can use params:
     *     ->addParams(['full' => 'true'])
     *     ->addParams(['sort' => '{"_system.created_on.ms": 1}'])
     * use mongodb $in statment in query
     * {"_doc":{"$in":["f913cff03624ac461283","2a41694a7fa7191d3e97"]}}
     *
     * @param  string $payload
     * @return 
     */
     public function query($query){
          $this->method = 'POST';
          $this->request = $this->baseUrl.'/repositories/'.$this->repositoryId.'/branches/'.$this->branch.'/nodes/query';
          $this->payload = $query;
          return $this;

     }

     /**
     * Finds around a node.
     * You can use params.
     *
     * @param  string $node
     * @param  string $payload
     * @return 
     */
     public function find($node, $payload){
          $this->method = 'POST';
          $this->request = $this->baseUrl.'/repositories/'.$this->repositoryId.'/branches/'.$this->branch.'/nodes/'.$node.'/find';
          $this->payload = $payload;
          return $this;

     }

     /**
     * Search for a node/nodes.
     * Pass params with the addParams() method 
     * examples (can be combined):
     *    ->addParams(['full' => 'true'])  
     *    ->addParams(['text' => $query])  
     *    ->addParams(['sort' => '{"_system.created_on.ms": 1}']) 
     * @return 
     */
     public function search(){
          $this->method = 'GET';
          $this->request = $this->baseUrl.'/repositories/'.$this->repositoryId.'/branches/'.$this->branch.'/nodes/search';
          return $this;

     }

     /**
     * Full search for a node/nodes. This method is more complete but more complex. You can use elastic search.
     * You need to POST a json payload.
     * https://www.elastic.co/guide/en/elasticsearch/reference/2.3/_executing_filters.html
     * examples of payloads:
     * Ex 1:
     *    '{"search": "cupcake"}'
     * Ex 2:
     *    '{
     *        "search": {
     *            "query_string" : {
     *                "default_field" : "body",
     *                "query" : "cupcakes AND chocolate"
     *            }
     *        }     
     *    }'
     * EX 3: 
     * '{"search": {
     *       "filtered": {    
     *           "filter": {
     *               "term": {
     *                   "_type":  "catalog_product",
     *                   "body":  "chocolate"
     *               }
     *            },
     *            "query": {
     *               "bool": {
     *                  "must": { "match_all": {} }
     *                },
     *                "filter":{
     *                   "range":{
     *                        "price":{"gte": 3}
     *                    }
     *                 }         
     *              }
     *          }
     *       }
     *    }         
     * }'
     * Of course you can pass params with the addParams() method
     *    ->addParams(['full' => 'true'])  
     *    ->addParams(['text' => $query])  
     *    ->addParams(['sort' => '{"_system.created_on.ms": 1}']) 
     * @return 
     */
     public function fullSearch($payload){
          $this->method = 'POST';
          $this->request = $this->baseUrl.'/repositories/'.$this->repositoryId.'/branches/'.$this->branch.'/nodes/search';
          $this->payload = $payload;
          return $this;

     }

     /**
     * Get a file 
     *
     * @param string $nodeId
     * @param string $path
     * @return string (url)
     * @todo maybe we need to move this out
     */
     public function getFile($nodeId, $path){
          $this->fileUrl = $this->deploymentUrl.'/static/'.$path.$nodeId;
          return $this;
     }

     /**
     * 
     * @param string $nodeId
     * @return string (url)
     * @todo maybe we need to move this out
     */
     public function getImage($nodeId){
          $this->imageUrl = $this->deploymentUrl.'/preview/node/'.$nodeId;
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
