<?php

namespace LoneCat\Filesystem\Stream;

abstract class PlainFileStream extends FileStream
{

    protected function getResource()
    {
        return fopen($this->filename, $this->mode);
    }

    public function close(): void
    {
        if ($this->isOpen()) {
            fclose($this->resource);
        }
        $this->resource = null;
    }
}