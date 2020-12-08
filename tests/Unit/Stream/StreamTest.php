<?php

namespace LoneCat\Filesystem\Tests\Unit\Stream;

use LoneCat\Filesystem\Stream\Stream;
use LoneCat\Filesystem\Tests\Unit\Stream\Mocks\StreamMock;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class StreamTest extends TestCase
{

    use StreamTestTrait;

    public function testConstruct(): Stream
    {
        $resource = fopen('php://memory', 'r+');
        $stream = new StreamMock($resource);
        Assert::assertEquals(true, $stream instanceof Stream);
        return $stream;
    }

    public function testConstructAndClose(): Stream
    {
        $resource = fopen('php://memory', 'r+');
        $stream = new StreamMock($resource);
        $stream->close();
        Assert::assertEquals(true, $stream instanceof Stream);
        return $stream;
    }

}