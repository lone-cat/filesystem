<?php

namespace LoneCat\Filesystem\Tests\Unit\Stream;

use LoneCat\Filesystem\Exception\Stream\StreamInvalidResource;
use LoneCat\Filesystem\Tests\Unit\Stream\Mocks\TestStream;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class StreamTest extends TestCase
{

    public function testValidConstructorParameter()
    {
        $resource = fopen('php://memory', 'r+');
        $stream = new TestStream($resource);
        Assert::assertEquals(true, $stream->isOpen());
        fclose($resource);
    }

    public function testInvalidConstructorParameter()
    {
        $resource = fopen('php://memory', 'r+');
        fclose($resource);
        try {
            $stream = new TestStream($resource);
            Assert::assertEquals(false, true);
        } catch (StreamInvalidResource $e) {
            Assert::assertEquals(true, true);
        }

    }

    public function testIsOpenWhenOpen()
    {
        $resource = fopen('php://memory', 'r+');
        $stream = new TestStream($resource);
        Assert::assertEquals(true, $stream->isOpen());
        fclose($resource);
    }

    public function testIsOpenWhenClosed()
    {
        $resource = fopen('php://memory', 'r+');
        $stream = new TestStream($resource);
        fclose($resource);
        Assert::assertEquals(false, $stream->isOpen());
    }

}

