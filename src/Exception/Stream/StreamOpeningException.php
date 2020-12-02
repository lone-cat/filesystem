<?php

namespace LoneCat\Filesystem\Exception\Stream;

use Throwable;

class StreamOpeningException extends StreamException
{

    public function __construct(string $message = 'Exception opening stream!', Throwable $previous = null)
    {
        parent::__construct($message, $previous);
    }

}