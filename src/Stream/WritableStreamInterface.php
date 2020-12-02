<?php

namespace LoneCat\Filesystem\Stream;

use Iterator;

interface WritableStreamInterface extends StreamInterface
{
    public function writeAll(Iterator $dataIterator): void;
}