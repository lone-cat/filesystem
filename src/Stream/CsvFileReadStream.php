<?php

namespace LoneCat\Filesystem\Stream;

use LoneCat\Filesystem\Exception\Stream\StreamReadException;

class CsvFileReadStream extends TableDataTextFileReadStream
{

    protected string $valueSeparator;
    protected string $enclosureString;
    protected string $escapeString;

    public function __construct(string $filename,
        string $valueSeparator = ',',
        string $enclosureString = '"',
        string $escapeString = '\\',
        bool $containHeaders = true)
    {
        $this->valueSeparator = $valueSeparator;
        $this->enclosureString = $enclosureString;
        $this->escapeString = $escapeString;

        parent::__construct($filename, $containHeaders);
    }

    protected function processLine(string $line): array
    {
        $data = str_getcsv($line, $this->valueSeparator, $this->enclosureString, $this->escapeString);

        if (!$data) {
            throw new StreamReadException('Invalid csv line passed!');
        }

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