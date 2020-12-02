<?php

namespace LoneCat\Filesystem\Exception\Stream;

use Throwable;

class StreamBufferSizeInvalidException extends StreamException
{

    public function __construct(string $message = 'Invalid buffer size passed!', Throwable $previous = null)
    {
        parent::__construct($message, $previous);
    }

}