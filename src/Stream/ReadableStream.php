<?php

namespace LoneCat\Filesystem\Stream;

use LoneCat\Filesystem\Exception\Stream\StreamNonExistentFileException;

trait ReadableStream
{

    protected function checkFile(string $filename): void
    {
        if (!file_exists($filename)) {
            throw new StreamNonExistentFileException();
        }
    }

}