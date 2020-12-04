<?php

namespace LoneCat\Filesystem\Stream;

use Generator;

interface ReadableStreamInterface extends StreamInterface
{
    public function readAll(): Generator;

    public function read();
}