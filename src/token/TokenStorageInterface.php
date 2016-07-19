<?php

namespace Idealley\CloudCmsSDK\Token;

interface TokenStorageInterface
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
}
