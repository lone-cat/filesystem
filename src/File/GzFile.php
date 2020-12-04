<?php

namespace LoneCat\Filesystem\File;

use LoneCat\Filesystem\Exception\FileException;
use LoneCat\Filesystem\Stream\GzFileReadStream;

class GzFile extends File
{

    private int $bufferLength;

    public function __construct(string $filename, int $bufferLength = 4096)
    {
        parent::__construct($filename);
        $this->bufferLength = $bufferLength;
    }

    function openReadStream(): void
    {
        $this->stream = new GzFileReadStream($this->filename, $this->bufferLength);
    }

    function openWriteStream(): void
    {
        throw new FileException('Not implemented gz file writing!');
    }

}