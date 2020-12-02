<?php

namespace LoneCat\Filesystem\Stream;

use LoneCat\Filesystem\Exception\Stream\StreamOpenModeException;

abstract class FileStream extends Stream
{
    protected const BASE_OPEN_MODES = [
        'r',
        'w',
        'a',
        'x',
        'c',
    ];

    protected string $filename;
    protected string $mode;

    public function __construct(string $filename, string $mode)
    {
        $this->checkFile($filename);
        $this->filename = $filename;

        $this->checkMode($mode);
        $this->mode = $mode;

        $resource = $this->getResource();
        parent::__construct($resource);
    }

    abstract protected function checkFile(string $filename): void;

    protected function checkMode(string $mode): void
    {
        if ((mb_strlen($mode) > 0) && (mb_strlen($mode) < 5)) {
            if (in_array($mode, self::BASE_OPEN_MODES, true)) {
                return;
            }

            if (in_array(mb_substr($mode, 0, 1), self::BASE_OPEN_MODES, true)) {
                $leftOver = mb_substr($mode, 1);
                if ($leftOver === '+') {
                    return;
                }
                $rightEnd = mb_substr($leftOver, -1);
                if ($rightEnd === '+') {
                    $leftOver = mb_substr($leftOver, 0, mb_strlen($leftOver) - 1);
                }
                if (in_array($leftOver, ['t', 'b', 'te', 'be', 'e' , 'et', 'eb'], true)) {
                    return;
                }
            }
        }

        throw new StreamOpenModeException();
    }

    abstract protected function getResource();

}