<?php

namespace LoneCat\Filesystem\Tests\Unit\Stream;

use LoneCat\Filesystem\Exception\Stream\StreamExistentFileException;
use LoneCat\Filesystem\Exception\Stream\StreamNonExistentFileException;
use LoneCat\Filesystem\Stream\BinaryFileWriteStream;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class BinaryFileWriteStreamTest extends TestCase
{
    private $exampleFilesFolder;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->exampleFilesFolder = realpath(dirname(dirname(__DIR__))) . '/ExampleFiles/';
        $filename = $this->exampleFilesFolder . 'TestTextFile.txt';
        if (file_exists($filename)) {
            unlink($filename);
        }
    }

    public function testValidConstructorParameter()
    {
        $filename = $this->exampleFilesFolder . 'TestTextFile.txt';
        $stream = new BinaryFileWriteStream($filename);
        Assert::assertEquals(true, $stream->isOpen());
        $stream->close();
        unlink($filename);
    }

    public function testInvalidConstructorParameter()
    {
        $filename = $this->exampleFilesFolder . 'TextFile.txt';
        try {
            $stream = new BinaryFileWriteStream($filename);
            $stream->close();
            unlink($filename);
            Assert::assertEquals(false, true);
        } catch (StreamExistentFileException $e) {
            Assert::assertEquals(true, true);
        }
    }

    public function testWriteAll()
    {
        $filename = $this->exampleFilesFolder . 'TestTextFile.txt';
        $stream = new BinaryFileWriteStream($filename);
        $source = ['My text!' . "\n", 'And one more line.'];
        $stream->writeAll($source);
        Assert::assertEquals(file_get_contents($filename), implode('', $source));
        $stream->close();
        unlink($filename);
    }

    public function testClose()
    {
        $filename = $this->exampleFilesFolder . 'TestTextFile.txt';
        $stream = new BinaryFileWriteStream($filename);
        $stream->close();
        unlink($filename);
        Assert::assertEquals(false, $stream->isOpen());
    }

}