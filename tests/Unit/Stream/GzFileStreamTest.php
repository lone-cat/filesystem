<?php

namespace LoneCat\Filesystem\Tests\Unit\Stream;

use LoneCat\Filesystem\Exception\Stream\StreamOpenModeException;
use LoneCat\Filesystem\Stream\Stream;
use LoneCat\Filesystem\Tests\Unit\Stream\Mocks\GzFileStreamMock;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class GzFileStreamTest extends TestCase
{
    use GzFileStreamTestTrait;

    private string $filename;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $exampleFilesFolder = realpath(dirname(dirname(__DIR__))) . '/ExampleFiles/';
        $this->filename = $exampleFilesFolder . 'TextFile.txt';
    }

    public function testConstruct(): Stream
    {
        $stream = new GzFileStreamMock($this->filename, 'rt');
        Assert::assertEquals(true, $stream instanceof Stream);
        return $stream;
    }

    public function testConstructAndClose(): Stream
    {
        $stream = new GzFileStreamMock($this->filename, 'rt');
        $stream->close();
        Assert::assertEquals(true, $stream instanceof Stream);
        return $stream;
    }

    public function testInvalidConstructByMode()
    {
        try {
            $stream = new GzFileStreamMock($this->filename, 'wtf???');
        } catch (StreamOpenModeException $e) {
            Assert::assertEquals(true, true);
            return;
        } catch (\Throwable $e) {
            Assert::assertEquals(false, true);
        }
        Assert::assertEquals(false, true);
    }

}