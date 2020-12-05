<?php

namespace LoneCat\Filesystem\File;

use Generator;
use Iterator;
use LoneCat\Filesystem\Exception\FileException;
use LoneCat\Filesystem\Stream\ReadableStreamInterface;
use LoneCat\Filesystem\Stream\Stream;
use LoneCat\Filesystem\Stream\WritableStreamInterface;

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

    public function getStream(): ?Stream
    {
        return $this->stream;
    }

    public function isStreamOpen(): bool
    {
        if (!($this->stream instanceof Stream)) {
            return false;
        }

        return $this->stream->isOpen();
    }

    public function getFileContents(): string
    {
        return file_get_contents($this->filename);
    }

    public function readToEnd(): Generator
    {
        $this->prepareToRead();
        foreach ($this->stream->readAll() as $dataBlock) {
            yield $dataBlock;
        }
        $this->closeStream();
    }

    public function read(): string
    {
        $this->prepareToRead();
        return $this->stream->read();
    }

    public function writeFileDataFromIterable(iterable $dataIterator): void
    {
        $this->prepareToWrite();
        $this->stream->writeAll($dataIterator);
        $this->closeStream();
    }

    public function write(string $data): void
    {
        $this->prepareToWrite();
        $this->stream->write($data);
    }

    public function prepareToRead(): void
    {
        if ($this->stream instanceof Stream) {
            if ($this->stream instanceof ReadableStreamInterface) {
                return;
            } else {
                throw new FileException('File is prepaired for another work!');
            }
        }

        $this->openReadStream();
    }

    abstract public function openReadStream(): void;

    public function prepareToWrite(): void
    {
        if ($this->stream instanceof Stream) {
            if ($this->stream instanceof WritableStreamInterface) {
                return;
            } else {
                throw new FileException('File is prepaired for another work!');
            }
        }

        $this->openWriteStream();
    }

    abstract public function openWriteStream(): void;

    public function closeStream(): void
    {
        if ($this->stream instanceof Stream) {
            $this->stream->close();
        }

        $this->stream = null;
    }

}