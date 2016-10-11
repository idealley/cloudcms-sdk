<?php

namespace Idealley\CloudCmsSDK\Model;

use Symfony\Component\Yaml\Yaml;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem as File;
use Idealley\CloudCmsSDK\Storage\StorageInterface;

class FileModelStorage implements StorageInterface
{
    /**
     * @var null|string
     */
    private $file;
    /**
     * @var string
     */
    private $path;

    /**
     * @var Filesystem
     */
    private $fileSystem;

    /**
     * @param string $path
     */
    public function __construct($file = null, $path = '../storage/cloudcms/model')
    {
        if ($file === null) {
            $file = 'model';
        }

        $this->adapter = new Local($path);
        $this->filesystem = new File($this->adapter);
        $this->file = $file;

    }

    /**
     * @return object
     */
    public function read()
    {
        if(!$this->filesystem->has('model')){
            return null;
        }
        //We return an object as it will be used for the parser.
        $content = Yaml::parse($this->filesystem->read($this->file));

        return $content['model'] ?? null;
    }

    /**
    * Parses the model before saving it.
    * @param array $content
    */
    public function write(array $content)
    {
        $parsed = [];
        foreach($content['model'] as $key => $value){
            foreach($value as $k => $v){
                if($k == "properties"){
                    foreach($v as $k2 => $property){
                        $parsed[$key][$k2] = false;
                    }
                } elseif($k == "items"){
                    foreach ($v as $k2 => $property) { 
                        if($k2 == "properties"){
                            foreach($property as $k3 => $v3){
                                $parsed[$key][0][$k3] = false; 
                            }
                        }
                    }
                } else {
                    $parsed[$key] = false;
                }          
            } 
            
        }

        $content['model'] = $parsed;
        $content['model']['_system'] = false;
        $content['model']['_qname'] = false;
        $content['model']['_statistics'] = false; 
        $this->filesystem->put($this->file, Yaml::dump($content));
    }

    /**
     * @param array $content
     */
    public function delete()
    {
        $this->filesystem->delete($this->file);
    }
}
