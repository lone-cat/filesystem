<?php

namespace LoneCat\Filesystem\File;

use LoneCat\Filesystem\Stream\BinaryFileReadStream;
use LoneCat\Filesystem\Stream\BinaryFileWriteStream;

class BinaryFile extends File
{

    function openReadStream(): void
    {
        $this->stream = new BinaryFileReadStream($this->filename);
    }

    function openWriteStream(): void
    {
        $this->stream = new BinaryFileWriteStream($this->filename);
    }

}