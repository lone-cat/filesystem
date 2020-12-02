<?php

namespace LoneCat\Filesystem\Tests\Unit\Stream;

use LoneCat\Filesystem\Exception\Stream\StreamNonExistentFileException;
use LoneCat\Filesystem\Stream\TextFileReadStream;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class TextFileReadStreamTest extends TestCase
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
        $stream = new TextFileReadStream($filename);
        Assert::assertEquals(true, $stream->isOpen());
        $stream->close();
    }

    public function testInvalidConstructorParameter()
    {
        $filename = $this->exampleFilesFolder . 'NonExistentFile.txt';
        try {
            $stream = new TextFileReadStream($filename);
            Assert::assertEquals(false, true);
        } catch (StreamNonExistentFileException $e) {
            Assert::assertEquals(true, true);
        }
    }

    public function testReadAll()
    {
        $filename = $this->exampleFilesFolder . 'TextFile.txt';
        $stream = new TextFileReadStream($filename);
        $result = '';
        foreach ($stream->readAll() as $line) {
            $result .= $line;
        }
        Assert::assertEquals(file_get_contents($filename), $result);
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