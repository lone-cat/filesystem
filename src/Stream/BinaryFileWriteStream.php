<?php

namespace LoneCat\Filesystem\Stream;

use Exception;
use Iterator;

class BinaryFileWriteStream extends PlainFileStream implements WritableStream
{

    public function __construct(string $filename)
    {
        parent::__construct($filename, 'wb');
    }

    public function writeAll(Iterator $dataIterator): void
    {
        if (!$this->isOpen()) {
            throw new Exception('Stream is not open!');
        }

        foreach ($dataIterator as $dataBlock) {
            $result = fwrite($this->resource, $dataBlock);

            if (!$result) {
                throw new Exception('Impossible to write data!');
            }
        }
    }
}