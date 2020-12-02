<?php

namespace LoneCat\Filesystem\Exception\Stream;

use LoneCat\Filesystem\Exception\FileSystemException;
use Throwable;

class StreamException extends FileSystemException
{

    public function __construct(string $message = 'General stream exception!', Throwable $previous = null)
    {
        parent::__construct($message, $previous);
    }

}