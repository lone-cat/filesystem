<?php


namespace LoneCat\Filesystem\File;


use LoneCat\Filesystem\Exception\FileException;
use LoneCat\Filesystem\Stream\CsvFileReadStream;

class CsvFile extends File
{

    protected string $valueSeparator;
    protected string $enclosureString;
    protected bool $containHeaders;
    private string $escapeString;

    public function __construct(string $filename,
        string $valueSeparator = ',',
        string $enclosureString = '"',
        string $escapeString = '\\',
        bool $containHeaders = true)
    {
        parent::__construct($filename);
        $this->valueSeparator = $valueSeparator;
        $this->enclosureString = $enclosureString;
        $this->escapeString = $escapeString;
        $this->containHeaders = $containHeaders;
    }

    public function getHeaders(): array
    {
        $this->prepareToRead();
        return $this->stream->getHeaders();
    }

    public function openReadStream(): void
    {
        $this->stream = new CsvFileReadStream($this->filename, $this->valueSeparator, $this->enclosureString, $this->escapeString, $this->containHeaders);
    }

    public function openWriteStream(): void
    {
        throw new FileException('Not implemented text file writing!');
    }



}