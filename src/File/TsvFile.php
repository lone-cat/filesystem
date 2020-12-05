<?php

namespace LoneCat\Filesystem\File;

class TsvFile extends CsvFile
{
    protected string $valueSeparator = "\t";
}