<?php

namespace LoneCat\Filesystem\File;

use LoneCat\Filesystem\Exception\FileException;
use LoneCat\Filesystem\Stream\CsvFileReadStream;

class CsvFile extends DataTableTextFile
{

    protected string $enclosureString;
    protected string $escapeString;

    public function __construct(string $filename,
        string $valueSeparator = ',',
        string $enclosureString = '"',
        string $escapeString = '\\',
        bool $containHeaders = true)
    {
        $this->enclosureString = $enclosureString;
        $this->escapeString = $escapeString;
        parent::__construct($filename, $valueSeparator, $containHeaders);
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