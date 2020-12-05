<?php

namespace LoneCat\Filesystem\File;

use LoneCat\Filesystem\Exception\FileException;
use LoneCat\Filesystem\Stream\TextFileReadStream;

class TextFile extends File
{

    public function openReadStream(): void
    {
        $this->stream = new TextFileReadStream($this->filename);
    }

    public function openWriteStream(): void
    {
        throw new FileException('Not implemented text file writing!');
    }

}