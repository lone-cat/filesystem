<?php

namespace LoneCat\Filesystem\Tests\Unit\Stream\Mocks;

use LoneCat\Filesystem\Stream\FileStream;

class TestFileStream extends FileStream
{

    protected function getResource()
    {
        return fopen($this->filename, $this->mode);
    }

    public function close(): void
    {

    }

    protected function checkFile(string $filename): void
    {

    }

}