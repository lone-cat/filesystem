<?php

namespace LoneCat\Filesystem\Tests\Unit\Stream;

use LoneCat\Filesystem\Exception\Stream\StreamNonExistentFileException;
use LoneCat\Filesystem\Exception\Stream\StreamOpenModeException;
use LoneCat\Filesystem\Tests\Unit\Stream\Mocks\TestPlainFileStream;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class PlainFileStreamTest extends TestCase
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
        $stream = new TestPlainFileStream($filename, 'r');
        Assert::assertEquals(true, $stream->isOpen());
    }

    public function testInvalidConstructorParameterMode()
    {
        $filename = $this->exampleFilesFolder . 'TextFile.txt';
        try {
            $stream = new TestPlainFileStream($filename, 'sdfsdf');
            Assert::assertEquals(false, true);
        } catch (StreamOpenModeException $e) {
            Assert::assertEquals(true, true);
        }
    }

    public function testClose()
    {
        $filename = $this->exampleFilesFolder . 'TextFile.txt';
        $stream = new TestPlainFileStream($filename, 'r');
        $stream->close();
        Assert::assertEquals(false, $stream->isOpen());
    }

}