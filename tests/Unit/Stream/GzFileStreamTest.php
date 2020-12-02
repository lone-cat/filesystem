<?php

namespace LoneCat\Filesystem\Tests\Unit\Stream;

use LoneCat\Filesystem\Exception\Stream\StreamNonExistentFileException;
use LoneCat\Filesystem\Exception\Stream\StreamOpenModeException;
use LoneCat\Filesystem\Tests\Unit\Stream\Mocks\TestGzFileStream;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class GzFileStreamTest extends TestCase
{

    private $exampleFilesFolder;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->exampleFilesFolder = realpath(dirname(dirname(__DIR__))) . '/ExampleFiles/';
    }

    public function testValidConstructorParameter()
    {
        $filename = $this->exampleFilesFolder . 'TextFile.txt.gz';
        $stream = new TestGzFileStream($filename, 'r');
        Assert::assertEquals(true, $stream->isOpen());
    }

    public function testInvalidConstructorParameterMode()
    {
        $filename = $this->exampleFilesFolder . 'TextFile.txt.gz';
        try {
            $stream = new TestGzFileStream($filename, 'sdfsdf');
            Assert::assertEquals(false, true);
        } catch (StreamOpenModeException $e) {
            Assert::assertEquals(true, true);
        }
    }

    public function testClose()
    {
        $filename = $this->exampleFilesFolder . 'TextFile.txt.gz';
        $stream = new TestGzFileStream($filename, 'r');
        $stream->close();
        Assert::assertEquals(false, $stream->isOpen());
    }


}