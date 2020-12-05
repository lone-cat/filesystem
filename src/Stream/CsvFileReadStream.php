<?php

namespace LoneCat\Filesystem\Stream;

use Generator;
use LoneCat\Filesystem\Exception\Stream\StreamNotReadyException;
use LoneCat\Filesystem\Exception\Stream\StreamReadException;

class CsvFileReadStream extends TextFileReadStream
{

    private ?array $headers = null;

    private string $valueSeparator;

    public function __construct(string $filename, string $valueSeparator = ',', bool $containHeaders = true)
    {
        parent::__construct($filename);
        $this->valueSeparator = $valueSeparator;
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

    public function processLine(string $line)
    {
        return str_getcsv($line, $this->valueSeparator);
    }

    public function read(): string
    {
        return rtrim(parent::read(), "\n");
    }

    public function getHeaders(): ?array
    {
        return $this->headers;
    }

    protected function fillHeaders()
    {
        $line = $this->read();
        if (!$line) {
            throw new StreamReadException('No headers in file!');
        }

        $this->headers = $this->processLine($line);
    }

}