<?php

namespace LoneCat\Filesystem\Stream;

use Iterator;
use LoneCat\Filesystem\Exception\Stream\StreamNotReadyException;
use LoneCat\Filesystem\Exception\Stream\StreamReadException;

class TextFileReadStream extends PlainFileStream implements ReadableStreamInterface
{

    use ReadableStream;

    public function __construct(string $filename)
    {
        parent::__construct($filename, 'r');
    }

    public function readAll(): Iterator
    {
        if (!$this->isOpen()) {
            throw new StreamNotReadyException();
        }

        while (!feof($this->resource)) {
            yield $this->readLine();
        }
    }

    protected function readLine(): string
    {
        $readBuffer = fgets($this->resource);
        if (!$readBuffer) {
            throw new StreamReadException();
        }

        return $readBuffer;
    }
}