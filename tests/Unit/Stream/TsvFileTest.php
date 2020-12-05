<?php

namespace LoneCat\Filesystem\Tests\Unit\Stream;

use LoneCat\Filesystem\File\CsvFile;
use LoneCat\Filesystem\File\TsvFile;
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

    public function testSimple()
    {
        $filename = $this->exampleFilesFolder . 'File.tsv';
        $tsvFile = new CsvFile($filename, "\t", '', '\\');
        $headers = [
          'header1',
          'header2',
          'header3',
          'header4',
        ];
        Assert::assertEquals($headers, $tsvFile->getHeaders());
    }

}