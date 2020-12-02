<?php

namespace LoneCat\Filesystem\File;

use Exception;
use LoneCat\Filesystem\Stream\GzFileReadStream;

class GzFile extends File
{

    function openReadStream(): void
    {
        $this->stream = new GzFileReadStream($this->filename);
    }

    function openWriteStream(): void
    {
        throw new Exception('Not implemented gz file writing!');
    }

}