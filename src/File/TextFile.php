<?php

namespace LoneCat\Filesystem\File;

use Exception;
use LoneCat\Filesystem\Stream\TextFileReadStream;

class TextFile extends File
{

    function openReadStream(): void
    {
        $this->stream = new TextFileReadStream($this->filename);
    }

    function openWriteStream(): void
    {
        throw new Exception('Not implemented text file writing!');
    }

}