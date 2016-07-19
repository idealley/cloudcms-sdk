<?php

namespace Idealley\CloudCmsSDK\Token;

use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem as File;
use Symfony\Component\Yaml\Yaml;

class FileTokenStorage implements TokenStorageInterface
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
    public function __construct($file = null, $path = '../storage/token')
    {
        if ($file === null) {
            $file = 'token';
        }

        $adapter = new Local($path);
        $this->filesystem = new File($adapter);
        $this->file = $file;

    }

    /**
     * {@inheritdoc}
     */
    public function read($key = 'token')
    {
        if(!$this->filesystem->has('token')){
            return null;
        }
        $content = Yaml::parse($this->filesystem->read($this->file));

        return isset($content[$key]) ? $content[$key] : null;
    }

    /**
     * @param array $content
     */
    public function write(array $content)
    {
        $this->filesystem->put($this->file, Yaml::dump($content));
    }
}
