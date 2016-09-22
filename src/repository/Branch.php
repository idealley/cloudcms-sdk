<?php

namespace Idealley\CloudCmsSDK\Repository;

class Branch extends Repository{

    /**
     * Get a schema by qname
     * Takes params such as metadata, full, locale
     * You can add params (examples):
     *     ->addParams(['full' => 'true'])
     *     ->addParams(['locale' => 'default])
     * 
     * @param  string $qname
     * @return 
     */
     public function getSchema($qname){
          $this->method = 'GET';
          $this->request = $this->baseUrl.'/repositories/'.$this->repositoryId.'/branches/'.$this->branch.'/schemas/'.$qname;
          return $this;
     }
}