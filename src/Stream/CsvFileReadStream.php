<?php

namespace LoneCat\Filesystem\Stream;

use Generator;
use LoneCat\Filesystem\Exception\Stream\StreamNotReadyException;

class CsvFileReadStream extends TextFileReadStream
{

    private string $valueSeparator;

    public function __construct(string $filename, string $valueSeparator = ',')
    {
        parent::__construct($filename);
        $this->valueSeparator = $valueSeparator;
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

}