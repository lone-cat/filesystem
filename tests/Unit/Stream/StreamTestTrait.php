<?php

namespace LoneCat\Filesystem\Tests\Unit\Stream;

use LoneCat\Filesystem\Stream\Stream;
use PHPUnit\Framework\Assert;

trait StreamTestTrait
{
    /**
     * @depends testConstruct
     */
    public function testGetResource(Stream $stream)
    {
        Assert::assertEquals(true, is_resource($stream->getResource()));
    }

    /**
     * @depends testConstructAndClose
     */
    public function testGetResourceAfterClosing(Stream $stream)
    {
        Assert::assertEquals(false, is_resource($stream->getResource()));
    }

    /**
     * @depends testConstruct
     * @depends testConstructAndClose
     */
    public function testIsOpen(Stream $stream, Stream $closedStream)
    {
        Assert::assertEquals($stream->isOpen(), is_resource($stream->getResource()));
        Assert::assertEquals($closedStream->isOpen(), is_resource($closedStream->getResource()));
    }

}