<?php

namespace LoneCat\Filesystem\Stream;

use Exception;
use Iterator;

class TextFileReadStream extends PlainFileStream implements ReadableStream
{

    public function __construct(string $filename)
    {
        parent::__construct($filename, 'r');
    }

    public function readAll(): Iterator
    {
        if (!$this->isOpen()) {
            throw new Exception('Stream is not open!');
        }

        while (!feof($this->resource)) {
            yield $this->readLine();
        }
    }

    protected function readLine(): string
    {
        $readBuffer = fgets($this->resource);
        if (!$readBuffer) {
            throw new Exception('Unable to read data!');
        }

        return $readBuffer;
    }
}