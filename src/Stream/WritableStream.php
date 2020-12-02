<?php

namespace LoneCat\Filesystem\Stream;

use LoneCat\Filesystem\Exception\Stream\StreamExistentFileException;
use LoneCat\Filesystem\Exception\Stream\StreamNonExistentPathException;

trait WritableStream
{

    protected function checkFile(string $filename): void
    {
        if (file_exists($filename)) {
            throw new StreamExistentFileException();
        }

        if (!is_dir(dirname($filename))) {
            throw new StreamNonExistentPathException();
        }
    }

}