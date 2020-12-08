<?php

namespace LoneCat\Filesystem\Tests\Unit\Stream;

use LoneCat\Filesystem\Stream\Stream;
use LoneCat\Filesystem\Stream\WritableStreamInterface;
use LoneCat\Filesystem\Tests\Unit\Stream\Mocks\StreamMock;
use PHPUnit\Framework\Assert;

trait BinaryWriteStreamTestTrait
{
    use FileStreamTestTrait;

    /**
     * @depends testConstruct
     */
    public function testWrite(WritableStreamInterface $stream)
    {
        $stream->write('abc');
        Assert::assertEquals(true, true);
    }

    /**
     * @depends testConstruct
     */
    public function testWriteAll(WritableStreamInterface $stream)
    {
        $stream->writeAll(['abc', 'def']);
        Assert::assertEquals(true, true);
    }
}