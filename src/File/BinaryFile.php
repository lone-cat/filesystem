<?php

namespace LoneCat\Filesystem\File;

use LoneCat\Filesystem\Stream\BinaryFileReadStream;
use LoneCat\Filesystem\Stream\BinaryFileWriteStream;

class BinaryFile extends File
{

    private int $bufferLength;

    public function __construct(string $filename, int $bufferLength = 4096)
    {
        parent::__construct($filename);
        $this->bufferLength = $bufferLength;
    }

    function openReadStream(): void
    {
        $this->stream = new BinaryFileReadStream($this->filename, $this->bufferLength);
    }

    function openWriteStream(): void
    {
        $this->stream = new BinaryFileWriteStream($this->filename);
    }

}