<?php

namespace LoneCat\Filesystem\Exception\Stream;

use Throwable;

class StreamNotReadyException extends StreamException
{

    public function __construct(string $message = 'Stream is in invalid state before operation!', Throwable $previous = null)
    {
        parent::__construct($message, $previous);
    }

}