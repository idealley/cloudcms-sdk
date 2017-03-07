<?php

namespace Idealley\CloudCmsSDK\Storage;

interface StorageInterface
{
    /**
     * @return mixed
     */
    public function read();

    /**
     * @param  array $content
     * @return mixed
     */
    public function write(array $content);

    /**  
     * @return mixed
     */
    public function delete();
}
