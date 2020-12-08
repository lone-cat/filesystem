<?php

namespace LoneCat\Filesystem\Tests\Unit\Stream;

use LoneCat\Filesystem\Exception\Stream\StreamNonExistentPathException;
use LoneCat\Filesystem\Exception\Stream\StreamOpenModeException;
use LoneCat\Filesystem\Stream\BinaryFileWriteStream;
use LoneCat\Filesystem\Stream\Stream;
use LoneCat\Filesystem\Tests\Unit\Stream\Mocks\PlainFileStreamMock;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class BinaryFileWriteStreamTest extends TestCase
{
    use BinaryWriteStreamTestTrait;

    private string $filename;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $exampleFilesFolder = realpath(dirname(dirname(__DIR__))) . '/ExampleFiles/';
        $this->filename = $exampleFilesFolder . 'TestTextFile.txt';
    }

    public function testConstruct(): Stream
    {
        $stream = new BinaryFileWriteStream($this->filename);
        Assert::assertEquals(true, $stream instanceof Stream);
        return $stream;
    }

    public function testConstructAndClose(): Stream
    {
        $stream = new BinaryFileWriteStream($this->filename);
        $stream->close();
        Assert::assertEquals(true, $stream instanceof Stream);
        return $stream;
    }

    public function testInvalidConstructByFileName()
    {
        try {
            $stream = new BinaryFileWriteStream('/wtf???/a');
        } catch (StreamNonExistentPathException $e) {
            Assert::assertEquals(true, true);
            return;
        } catch (\Throwable $e) {
            Assert::assertEquals(false, true);
        }
        Assert::assertEquals(false, true);
    }

}