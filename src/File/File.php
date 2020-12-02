<?php

namespace LoneCat\Filesystem\File;

use Exception;
use Iterator;
use LoneCat\Filesystem\Stream\ReadableStream;
use LoneCat\Filesystem\Stream\Stream;
use LoneCat\Filesystem\Stream\WritableStream;

abstract class File
{

    protected string $filename;
    protected ?Stream $stream;

    public function __construct(string $filename)
    {
        $this->filename = $filename;
        $this->stream = null;
    }

    public function getFileName(): string
    {
        return $this->filename;
    }

    public function getFileContents(): string
    {
        return file_get_contents($this->filename);
    }

    public function iterateFileData(): Iterator
    {
        $this->prepareToRead();
        foreach ($this->stream->readAll() as $dataBlock) {
            yield $dataBlock;
        }
        $this->closeStream();
    }

    public function writeFileDataFromIterator(Iterator $dataIterator): void
    {
        $this->prepareToWrite();
        $this->stream->writeAll($dataIterator);
        $this->closeStream();
    }

    public function prepareToRead(): void
    {
        if ($this->stream instanceof Stream) {
            if ($this->stream instanceof ReadableStream) {
                return;
            } else {
                throw new Exception('File is prepaired for another work!');
            }
        }

        $this->openReadStream();
    }

    abstract function openReadStream(): void;

    public function prepareToWrite(): void
    {
        if ($this->stream instanceof Stream) {
            if ($this->stream instanceof WritableStream) {
                return;
            } else {
                throw new Exception('File is prepaired for another work!');
            }
        }

        $this->openWriteStream();
    }

    abstract function openWriteStream(): void;

    function closeStream(): void
    {
        if ($this->stream instanceof Stream) {
            $this->stream->close();
        }

        $this->stream = null;
    }

}