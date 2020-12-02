<?php

namespace LoneCat\Filesystem\Exception\Stream;

use Throwable;

class StreamWriteException extends StreamException
{

    public function __construct(string $message = 'Exception writing to stream!', Throwable $previous = null)
    {
        parent::__construct($message, $previous);
    }

}