<?php

namespace LoneCat\Filesystem\Tests\Unit\Stream;

use LoneCat\Filesystem\File\TextFile;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class BasicTest extends TestCase
{

    private $exampleFilesFolder;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->exampleFilesFolder = realpath(dirname(dirname(__DIR__)));
    }

    public function testStream()
    {
        $path = $this->exampleFilesFolder . '/ExampleFiles/TextFile.txt';
        $textFile = new TextFile($path);
        Assert::assertEquals(true, true);
    }

}