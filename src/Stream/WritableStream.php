<?php

namespace LoneCat\Filesystem\Stream;

use Iterator;

interface WritableStream extends StreamInterface
{
    public function writeAll(Iterator $dataIterator): void;
}