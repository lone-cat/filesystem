<?php

namespace LoneCat\Filesystem\Tests\Unit\File;

use LoneCat\Filesystem\File\CsvFile;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class TsvFileTest extends TestCase
{

    private $exampleFilesFolder;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->exampleFilesFolder = realpath(dirname(dirname(__DIR__))) . '/ExampleFiles/';
    }

    public function testHeaders()
    {
        $filename = $this->exampleFilesFolder . 'File.tsv';
        $tsvFile = new CsvFile($filename, "\t", '"', '\\');
        $headers = [
          'header1',
          'header2',
          'header3',
          'header4',
          'header5',
          'header6',
          'header7',
          'header8',
          'header9',
        ];
        Assert::assertEquals($headers, $tsvFile->getHeaders());
    }

}