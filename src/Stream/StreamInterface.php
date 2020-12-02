<?php

namespace LoneCat\Filesystem\Stream;

interface StreamInterface
{

    public function isOpen(): bool;

    public function close(): void;

}