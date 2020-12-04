<?php

namespace LoneCat\Filesystem\Stream;

use Generator;
use Iterator;
use LoneCat\Filesystem\Exception\Stream\StreamBufferSizeInvalidException;
use LoneCat\Filesystem\Exception\Stream\StreamNotReadyException;
use LoneCat\Filesystem\Exception\Stream\StreamReadException;

class GzFileReadStream extends GzFileStream implements ReadableStreamInterface
{

    use ReadableStream;

    protected int $bufferLength;

    public function __construct(string $filename, int $bufferLength = 4096)
    {
        if ($bufferLength < 1) {
            throw new StreamBufferSizeInvalidException();
        }
        $this->bufferLength = $bufferLength;
        parent::__construct($filename, 'rb');
    }

    public function readAll(): Generator
    {
        if (!$this->isOpen()) {
            throw new StreamNotReadyException();
        }

        while (!gzeof($this->resource)) {
            yield $this->read();
        }
    }

    public function read(): string
    {
        $readBuffer = gzread($this->resource, $this->bufferLength);
        if ($readBuffer === false) {
            throw new StreamReadException();
        }

        return $readBuffer;
    }
}