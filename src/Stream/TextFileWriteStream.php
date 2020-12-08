<?php

namespace LoneCat\Filesystem\Stream;

use LoneCat\Filesystem\Exception\Stream\StreamNotReadyException;
use LoneCat\Filesystem\Exception\Stream\StreamWriteException;

class TextFileWriteStream extends PlainFileStream implements WritableStreamInterface
{

    use WritableStream;

    private string $endOfLine;

    public function __construct(string $filename, string $endOfLine = "\n")
    {
        parent::__construct($filename, 'wt');
        $this->endOfLine = $endOfLine;
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

    public function writeAllLines(iterable $dataIterator): void
    {
        if (!$this->isOpen()) {
            throw new StreamNotReadyException();
        }

        foreach ($dataIterator as $dataBlock) {
            $this->writeLn($dataBlock);
        }
    }

    public function write(string $data): void
    {
        $result = fwrite($this->resource, $data);

        if ($result === false) {
            throw new StreamWriteException();
        }
    }

    public function writeLn(string $data): void
    {
        $this->write($data . $this->endOfLine);
    }
}