<?php

namespace LoneCat\Filesystem\Exception;

use Exception;
use Throwable;

class FileSystemException extends Exception
{

    public function __construct(string $message = 'General file system exception!', Throwable $previous = null)
    {
        $code = 1;
        parent::__construct($message, $code, $previous);
    }

}