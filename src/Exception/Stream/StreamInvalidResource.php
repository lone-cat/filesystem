<?php

namespace LoneCat\Filesystem\Exception\Stream;

use Throwable;

class StreamInvalidResource extends StreamException
{

    public function __construct(string $message = 'Invalid resource given!', Throwable $previous = null)
    {
        parent::__construct($message, $previous);
    }

}