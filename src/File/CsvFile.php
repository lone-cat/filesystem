<?php


namespace LoneCat\Filesystem\File;


use LoneCat\Filesystem\Exception\FileException;
use LoneCat\Filesystem\Stream\CsvFileReadStream;

class CsvFile extends File
{

    protected string $valueSeparator = ',';

    public function getHeaders(): array
    {
        $this->prepareToRead();
        return $this->stream->getHeaders();
    }

    public function openReadStream(bool $containsHeaders = true): void
    {
        $this->stream = new CsvFileReadStream($this->filename, $this->valueSeparator, $containsHeaders);
    }

    public function openWriteStream(): void
    {
        throw new FileException('Not implemented text file writing!');
    }



}