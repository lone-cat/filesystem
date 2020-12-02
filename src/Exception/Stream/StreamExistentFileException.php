<?php

namespace LoneCat\Filesystem\Exception\Stream;

use Throwable;

class StreamExistentFileException extends StreamException
{

    public function __construct(string $message = 'File name passed for write stream already exist!', Throwable $previous = null)
    {
        parent::__construct($message, $previous);
    }

}