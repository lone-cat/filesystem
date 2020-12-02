<?php

namespace LoneCat\Filesystem\Tests\Unit\Stream;

use LoneCat\Filesystem\Exception\Stream\StreamNonExistentFileException;
use LoneCat\Filesystem\Exception\Stream\StreamOpenModeException;
use LoneCat\Filesystem\Tests\Unit\Stream\Mocks\TestFileStream;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class FileStreamTest extends TestCase
{

    private $exampleFilesFolder;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->exampleFilesFolder = realpath(dirname(dirname(__DIR__))) . '/ExampleFiles/';
    }

    public function testValidConstructorParameters()
    {
        $filename = $this->exampleFilesFolder . 'TextFile.txt';
        $stream = new TestFileStream($filename, 'r');
        Assert::assertEquals(true, $stream->isOpen());
    }

    public function testInvalidConstructorParameterMode()
    {
        $filename = $this->exampleFilesFolder . 'TextFile.txt';
        try {
            $stream = new TestFileStream($filename, 'safdasf');
            Assert::assertEquals(false, true);
        } catch (StreamOpenModeException $e) {
            Assert::assertEquals(true, true);
        }
    }

}