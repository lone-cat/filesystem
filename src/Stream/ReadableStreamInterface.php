<?php

namespace LoneCat\Filesystem\Stream;

use Iterator;

interface ReadableStreamInterface extends StreamInterface
{
    public function readAll(): Iterator;
}