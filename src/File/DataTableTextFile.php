<?php

namespace LoneCat\Filesystem\File;

abstract class DataTableTextFile extends File
{

    protected string $valueSeparator;
    protected bool $containHeaders;

    public function __construct(string $filename,
        string $valueSeparator = ',',
        bool $containHeaders = true)
    {
        $this->valueSeparator = $valueSeparator;
        $this->containHeaders = $containHeaders;
        parent::__construct($filename);
    }

    public function getHeaders(): ?array
    {
        $this->prepareToRead();
        return $this->stream->getHeaders();
    }

}