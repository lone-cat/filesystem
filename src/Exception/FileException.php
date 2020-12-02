<?php

namespace LoneCat\Filesystem\Exception;

use Throwable;

class FileException extends FileSystemException
{

    public function __construct(string $message = 'General file exception!', Throwable $previous = null)
    {
        parent::__construct($message, $previous);
    }

}