<?php

namespace LoneCat\Filesystem\Stream;

use Exception;
use Iterator;

class BinaryFileReadStream extends PlainFileStream implements ReadableStream
{

    protected int $bufferLength;

    public function __construct(string $filename, int $bufferLength = 4096)
    {
        if ($bufferLength < 1) {
            throw new Exception('Buffer less then 1!');
        }
        $this->bufferLength = $bufferLength;
        parent::__construct($filename, 'rb');
    }

    public function readAll(): Iterator
    {
        if (!$this->isOpen()) {
            throw new Exception('Stream is not open!');
        }

        while (!feof($this->resource)) {
            yield $this->readBlock();
        }
    }

    protected function readBlock(): string
    {
        $readBuffer = fread($this->resource, $this->bufferLength);
        if (!$readBuffer) {
            throw new Exception('Unable to read data!');
        }

        return $readBuffer;
    }

}