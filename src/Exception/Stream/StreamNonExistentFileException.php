<?php

namespace LoneCat\Filesystem\Exception\Stream;

use Throwable;

class StreamNonExistentFileException extends StreamException
{

    public function __construct(string $message = 'File name passed for stream creation was not found!', Throwable $previous = null)
    {
        parent::__construct($message, $previous);
    }

}