<?php

namespace LoneCat\Filesystem\Stream;

use Iterator;
use LoneCat\Filesystem\Exception\Stream\StreamNotReadyException;
use LoneCat\Filesystem\Exception\Stream\StreamReadException;

class TsvFileReadStream extends TextFileReadStream
{

    public function readAllAsArray(): Iterable
    {
        if (!$this->isOpen()) {
            throw new StreamNotReadyException();
        }

        while (!feof($this->resource)) {
            yield $this->readLineAsArray();
        }
    }

    protected function readLineAsArray(): array
    {
        $readBuffer = fgetcsv($this->resource, 0, "\t");
        if (!$readBuffer) {
            throw new StreamReadException();
        }

        return $readBuffer;
    }

}