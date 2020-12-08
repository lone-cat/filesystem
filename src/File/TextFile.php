<?php

namespace LoneCat\Filesystem\File;

use LoneCat\Filesystem\Stream\TextFileReadStream;
use LoneCat\Filesystem\Stream\TextFileWriteStream;

class TextFile extends File
{

    public function openReadStream(): void
    {
        $this->stream = new TextFileReadStream($this->filename);
    }

    public function openWriteStream(): void
    {
        $this->stream = new TextFileWriteStream($this->filename);
        //throw new FileException('Not implemented text file writing!');
    }

}