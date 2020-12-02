<?php

namespace LoneCat\Filesystem\Exception\Stream;

use Throwable;

class StreamOpenModeException extends StreamException
{

    public function __construct(string $message = 'Invalid stream open mode passed!', Throwable $previous = null)
    {
        parent::__construct($message, $previous);
    }

}