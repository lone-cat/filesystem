<?php

namespace LoneCat\Filesystem\Tests\Unit\Stream\Mocks;

use LoneCat\Filesystem\Exception\FileSystemException;
use LoneCat\Filesystem\Stream\FileStream;

class FileStreamMock extends FileStream
{

    protected function generateResource()
    {
        return fopen($this->filename, $this->mode);
    }

    public function close(): void
    {
        if (is_resource($this->resource)) {
            fclose($this->resource);
        }
    }

    protected function checkFile(string $filename): void
    {
        //throw new FileSystemException('Not implemented!');
    }

}