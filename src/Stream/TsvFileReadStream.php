<?php

namespace LoneCat\Filesystem\Stream;

use Generator;
use LoneCat\Filesystem\Exception\Stream\StreamNotReadyException;
use LoneCat\Filesystem\Exception\Stream\StreamReadException;

class TsvFileReadStream extends PlainFileStream implements ReadableStreamInterface
{

    use ReadableStream;

    public function __construct(string $filename)
    {
        parent::__construct($filename, 'r');
    }

    public function readAll(): Generator
    {
        if (!$this->isOpen()) {
            throw new StreamNotReadyException();
        }

        while (!feof($this->resource)) {
            yield $this->read();
        }
    }

    public function read(): array
    {
        $readBuffer = fgetcsv($this->resource, 0, "\t");
        if ($readBuffer === false) {
            throw new StreamReadException();
        }

        return $readBuffer;
    }

}