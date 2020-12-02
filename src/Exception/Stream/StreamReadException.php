<?php

namespace LoneCat\Filesystem\Exception\Stream;

use Throwable;

class StreamReadException extends StreamException
{

    public function __construct(string $message = 'Exception reading from stream!', Throwable $previous = null)
    {
        parent::__construct($message, $previous);
    }

}