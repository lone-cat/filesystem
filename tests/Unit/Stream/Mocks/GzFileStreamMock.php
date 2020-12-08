<?php

namespace LoneCat\Filesystem\Tests\Unit\Stream\Mocks;

use LoneCat\Filesystem\Exception\FileSystemException;
use LoneCat\Filesystem\Stream\GzFileStream;

class GzFileStreamMock extends GzFileStream
{

    protected function checkFile(string $filename): void
    {
        //throw new FileSystemException('Not implemented!');
    }

}