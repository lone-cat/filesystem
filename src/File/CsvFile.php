<?php


namespace LoneCat\Filesystem\File;


use LoneCat\Filesystem\Exception\FileException;
use LoneCat\Filesystem\Stream\CsvFileReadStream;

class CsvFile extends File
{

    protected string $valueSeparator = ',';

    private ?array $headers = null;

    public function getHeaders(): array
    {
        return $this->headers;
    }

    function openReadStream(bool $containsHeaders = true): void
    {
        $this->stream = new CsvFileReadStream($this->filename, $this->valueSeparator);
        if ($containsHeaders) {
            $this->headers = $this->stream->processLine($this->stream->read());
        }
    }

    function openWriteStream(): void
    {
        throw new FileException('Not implemented text file writing!');
    }

}