<?php

namespace LoneCat\Filesystem\Tests\Unit\Stream;

use LoneCat\Filesystem\Stream\WritableStreamInterface;
use PHPUnit\Framework\Assert;

trait TextFileWriteStreamTestTrait
{
    use BinaryWriteStreamTestTrait;

    /**
     * @depends testConstruct
     */
    public function testWriteLn(WritableStreamInterface $stream)
    {
        $stream->writeLn('abc');
        Assert::assertEquals(true, true);
    }

    /**
     * @depends testConstruct
     */
    public function testWriteAllLines(WritableStreamInterface $stream)
    {
        $stream->writeAllLines(['abc', 'def']);
        Assert::assertEquals(true, true);
    }
}