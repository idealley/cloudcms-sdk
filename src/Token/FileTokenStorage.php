<?php

namespace Idealley\CloudCmsSDK\Token;

use Symfony\Component\Yaml\Yaml;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem as File;
use Idealley\CloudCmsSDK\Storage\StorageInterface;

class FileTokenStorage implements StorageInterface
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
    public function __construct($file = null, $path = '../storage/cloudcms/token')
    {
        if ($file === null) {
            $file = 'token';
        }

        $this->adapter = new Local($path);
        $this->filesystem = new File($this->adapter);
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

        return $content[$key] ?? null;
    }

    /**
     * @param array $content
     */
    public function write(array $content)
    {
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
