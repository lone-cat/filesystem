<?php

namespace LoneCat\Filesystem\Stream;

use Iterator;

interface ReadableStream extends StreamInterface
{
    public function readAll(): Iterator;
}