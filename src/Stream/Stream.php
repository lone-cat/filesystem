<?php

namespace LoneCat\Filesystem\Stream;

use Exception;

abstract class Stream implements StreamInterface
{
    protected $resource = null;

    public function __construct($resource) {
        $this->resource = $resource;

        if (!$this->isOpen()) {
            throw new Exception('Invalid resource given!');
        }
    }

    public function isOpen(): bool
    {
        return is_resource($this->resource);
    }

    abstract public function close(): void;
}