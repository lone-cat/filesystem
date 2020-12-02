<?php

namespace LoneCat\Filesystem\Stream;

use Exception;
use Iterator;

class TsvFileReadStream extends TextFileReadStream
{

    public function readAllAsArray(): Iterator
    {
        if (!$this->isOpen()) {
            throw new Exception('Stream is not open!');
        }

        while (!feof($this->resource)) {
            yield $this->readLineAsArray();
        }
    }

    protected function readLineAsArray(): array
    {
        $readBuffer = fgetcsv($this->resource, 0, "\t");
        if (!$readBuffer) {
            throw new Exception('Unable to read data!');
        }

        return $readBuffer;
    }

}