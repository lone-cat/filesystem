<?php

namespace LoneCat\Filesystem\Stream;

use LoneCat\Filesystem\Exception\Stream\StreamReadException;

class ImdbFileReadStream extends TableDataTextFileReadStream
{

    protected string $valueSeparator;

    public function __construct(string $filename,
        string $valueSeparator = "\t",
        bool $containHeaders = true)
    {
        $this->valueSeparator = $valueSeparator;
        parent::__construct($filename, $containHeaders);
    }

    protected function processLine(string $line): array
    {
        $data = explode($this->valueSeparator, $line);

        if ($this->headers) {
            $result = array_combine($this->headers, $data);
            if ($result === false) {
                throw new StreamReadException('Invalid columns amount!');
            }

            return $result;
        }

        return $data;
    }
}