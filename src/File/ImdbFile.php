<?php

namespace LoneCat\Filesystem\File;

use LoneCat\Filesystem\Exception\FileException;
use LoneCat\Filesystem\Stream\ImdbFileReadStream;

class ImdbFile extends DataTableTextFile
{

    public function __construct(string $filename, string $valueSeparator = "\t", bool $containHeaders = true)
    {
        parent::__construct($filename, $valueSeparator, $containHeaders);
    }

    public function openReadStream(): void
    {
        $this->stream = new ImdbFileReadStream($this->filename, $this->valueSeparator, $this->containHeaders);
    }

    public function openWriteStream(): void
    {
        throw new FileException('Not implemented text file writing!');
    }

}