<?php

namespace LoneCat\Filesystem\Exception\Stream;

use Throwable;

class StreamNonExistentPathException extends StreamException
{

    public function __construct(string $message = 'Non existence path exception!', Throwable $previous = null)
    {
        parent::__construct($message, $previous);
    }

}