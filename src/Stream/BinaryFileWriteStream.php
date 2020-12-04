<?php

namespace LoneCat\Filesystem\Stream;

use LoneCat\Filesystem\Exception\Stream\StreamNotReadyException;
use LoneCat\Filesystem\Exception\Stream\StreamWriteException;

class BinaryFileWriteStream extends PlainFileStream implements WritableStreamInterface
{

    use WritableStream;

    public function __construct(string $filename)
    {
        parent::__construct($filename, 'wb');
    }

    public function writeAll(iterable $dataIterator): void
    {
        if (!$this->isOpen()) {
            throw new StreamNotReadyException();
        }

        foreach ($dataIterator as $dataBlock) {
            $this->write($dataBlock);
        }
    }

    public function write(string $data): void
    {
        $result = fwrite($this->resource, $data);

        if ($result === false) {
            throw new StreamWriteException();
        }
    }
}