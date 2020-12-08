<?php

namespace LoneCat\Filesystem\Tests\Unit\Stream\Mocks;

use LoneCat\Filesystem\Exception\FileSystemException;
use LoneCat\Filesystem\Stream\Stream;

class StreamMock extends Stream
{

    public function close(): void
    {
        $this->resource = null;
    }

}