<?php

namespace LoneCat\Filesystem\Tests\Unit\Stream;

use LoneCat\Filesystem\Exception\Stream\StreamNonExistentFileException;
use LoneCat\Filesystem\Stream\CsvFileReadStream;
use LoneCat\Filesystem\Stream\TextFileReadStream;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class TsvFileReadStreamTest extends TestCase
{
    private $exampleFilesFolder;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->exampleFilesFolder = realpath(dirname(dirname(__DIR__))) . '/ExampleFiles/';
    }

    public function testValidConstructorParameter()
    {
        $filename = $this->exampleFilesFolder . 'File.tsv';
        $stream = new CsvFileReadStream($filename, "\t", '"', '\\', false);
        Assert::assertEquals(true, $stream->isOpen());
        $stream->close();
    }

    public function testInvalidConstructorParameter()
    {
        $filename = $this->exampleFilesFolder . 'NonExistentFile.tsv';
        try {
            $stream = new CsvFileReadStream($filename, "\t", '"', '\\', false);
            Assert::assertEquals(false, true);
        } catch (StreamNonExistentFileException $e) {
            Assert::assertEquals(true, true);
        }
    }

    public function testReadAll()
    {
        $filename = $this->exampleFilesFolder . 'File.tsv';
        $stream = new CsvFileReadStream($filename, "\t", '"', '\\', false);
        $result = [];
        foreach ($stream->readAll() as $line) {
            $result[] = $line;
        }

        $expectedResult = [
            [
                'header1',
                'header2',
                'header3',
                'header4',
                'header5',
                'header6',
                'header7',
                'header8',
                'header9'
            ],
            [
                'value1',
                'value' . "\t" . '1',
                'value" ' . "\t" . ' 1',
                '\N',
                'value" ' . "\t" . ' 1',
                '\N',
                'value" ' . "\t" . ' 1',
                '\N',
                '\N',
            ],
        ];
        Assert::assertEquals($expectedResult, $result);
        $stream->close();
    }

    public function testClose()
    {
        $filename = $this->exampleFilesFolder . 'File.tsv';
        $stream = new CsvFileReadStream($filename, "\t", '"', '\\', false);
        $stream->close();
        Assert::assertEquals(false, $stream->isOpen());
    }
}