<?php

namespace LoneCat\Filesystem\Stream;

interface WritableStreamInterface extends StreamInterface
{
    public function writeAll(iterable $dataIterator): void;

    public function write(string $data): void;
}