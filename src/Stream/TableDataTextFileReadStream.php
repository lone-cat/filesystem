<?php

namespace LoneCat\Filesystem\Stream;

use Generator;
use LoneCat\Filesystem\Exception\Stream\StreamNotReadyException;
use LoneCat\Filesystem\Exception\Stream\StreamReadException;

abstract class TableDataTextFileReadStream extends TextFileReadStream
{

    protected ?array $headers = null;

    protected bool $containHeaders;

    public function __construct(string $filename, bool $containHeaders)
    {
        parent::__construct($filename);
        $this->containHeaders = $containHeaders;

        if ($containHeaders) {
            $this->fillHeaders();
        }
    }

    public function readAll(): Generator
    {
        if (!$this->isOpen()) {
            throw new StreamNotReadyException();
        }

        while (!feof($this->resource)) {
            $line = $this->read();
            if ($line) {
                yield $this->processLine($line);
            }
        }
    }

    public function read(): string
    {
        return rtrim(parent::read(), "\n");
    }

    public function getHeaders(): ?array
    {
        return $this->headers;
    }

    abstract protected function processLine(string $line): array;

    protected function fillHeaders()
    {
        $line = $this->read();
        if (!$line) {
            throw new StreamReadException('No headers in file!');
        }

        $this->headers = $this->processLine($line);
    }

}