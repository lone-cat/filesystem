<?php

namespace LoneCat\Filesystem\Stream;

use Iterator;
use LoneCat\Filesystem\Exception\Stream\StreamBufferSizeInvalidException;
use LoneCat\Filesystem\Exception\Stream\StreamNotReadyException;
use LoneCat\Filesystem\Exception\Stream\StreamReadException;

class BinaryFileReadStream extends PlainFileStream implements ReadableStreamInterface
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

    public function readAll(): Iterator
    {
        if (!$this->isOpen()) {
            throw new StreamNotReadyException();
        }

        while (!feof($this->resource)) {
            yield $this->readBlock();
        }
    }

    protected function readBlock(): string
    {
        $readBuffer = fread($this->resource, $this->bufferLength);
        if (!$readBuffer) {
            throw new StreamReadException();
        }

        return $readBuffer;
    }

}