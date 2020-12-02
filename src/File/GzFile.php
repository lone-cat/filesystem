<?php

namespace LoneCat\Filesystem\File;

use LoneCat\Filesystem\Exception\FileException;
use LoneCat\Filesystem\Stream\GzFileReadStream;

class GzFile extends File
{

    function openReadStream(): void
    {
        $this->stream = new GzFileReadStream($this->filename);
    }

    function openWriteStream(): void
    {
        throw new FileException('Not implemented gz file writing!');
    }

}