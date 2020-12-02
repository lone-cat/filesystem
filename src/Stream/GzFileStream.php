<?php

namespace LoneCat\Filesystem\Stream;

abstract class GzFileStream extends FileStream
{

    protected function getResource()
    {
        return gzopen($this->filename, $this->mode);
    }

    public function close(): void
    {
        if ($this->isOpen()) {
            gzclose($this->resource);
        }
        $this->resource = null;
    }

}