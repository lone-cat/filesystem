<?php

namespace LoneCat\Filesystem\Stream;

use Generator;
use LoneCat\Filesystem\Exception\Stream\StreamNotReadyException;
use LoneCat\Filesystem\Exception\Stream\StreamReadException;

class TextFileReadStream extends PlainFileStream implements ReadableStreamInterface
{

    use ReadableStream;

    public function __construct(string $filename)
    {
        parent::__construct($filename, 'rt');
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

    public function read(): string
    {
        $readBuffer = fgets($this->resource);

        if ($readBuffer === false && !feof($this->resource)) {
            throw new StreamReadException();
        }

        return $readBuffer ?: '';
    }
}