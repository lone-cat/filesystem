<?php

namespace LoneCat\Filesystem\Tests\Unit\Stream;

use LoneCat\Filesystem\Exception\Stream\StreamNonExistentFileException;
use LoneCat\Filesystem\Stream\CsvFileReadStream;
use LoneCat\Filesystem\Stream\TextFileReadStream;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class CsvFileReadStreamTest extends TestCase
{
    private $exampleFilesFolder;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->exampleFilesFolder = realpath(dirname(dirname(__DIR__))) . '/ExampleFiles/';
    }

    public function testValidConstructorParameter()
    {
        $filename = $this->exampleFilesFolder . 'TextFile.txt';
        $stream = new CsvFileReadStream($filename);
        Assert::assertEquals(true, $stream->isOpen());
        $stream->close();
    }

    public function testInvalidConstructorParameter()
    {
        $filename = $this->exampleFilesFolder . 'NonExistentFile.txt';
        try {
            $stream = new CsvFileReadStream($filename);
            Assert::assertEquals(false, true);
        } catch (StreamNonExistentFileException $e) {
            Assert::assertEquals(true, true);
        }
    }

    public function testReadAll()
    {
        $filename = $this->exampleFilesFolder . 'File.csv';
        $stream = new CsvFileReadStream($filename);
        $result = [];
        foreach ($stream->readAll() as $line) {
            $result[] = $line;
        }

        $expectedResult = [
            ['header1', 'header2', 'header3', 'header4',],
            ['value1', 'value,1', 'value" , 1', '\N',],
        ];
        Assert::assertEquals($expectedResult, $result);
        $stream->close();
    }

    public function testClose()
    {
        $filename = $this->exampleFilesFolder . 'TextFile.txt';
        $stream = new TextFileReadStream($filename);
        $stream->close();
        Assert::assertEquals(false, $stream->isOpen());
    }
}