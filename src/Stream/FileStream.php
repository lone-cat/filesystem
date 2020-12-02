<?php

namespace LoneCat\Filesystem\Stream;

abstract class FileStream extends Stream
{

    protected string $filename;
    protected string $mode;

    public function __construct(string $filename, string $mode)
    {
        $this->filename = $filename;
        $this->mode = $mode;
        $resource = $this->getResource();
        parent::__construct($resource);
    }

    abstract protected function getResource();

}