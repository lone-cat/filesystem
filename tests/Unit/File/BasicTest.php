<?php

namespace LoneCat\Filesystem\Tests\Unit\File;

use LoneCat\Filesystem\File\GzFile;
use LoneCat\Filesystem\File\TextFile;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class BasicTest extends TestCase
{

    private $exampleFilesFolder;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->exampleFilesFolder = realpath(dirname(dirname(__DIR__))) . '/ExampleFiles/';
    }

    public function testGetContents()
    {
        $filePath = $this->exampleFilesFolder . 'TextFile.txt';
        $textFile = new TextFile($filePath);
        Assert::assertEquals(file_get_contents($filePath), $textFile->getFileContents());
    }

    public function testGetTextFileByStream()
    {
        $filePath = $this->exampleFilesFolder . 'TextFile.txt';
        $textFile = new TextFile($filePath);
        $result = '';
        foreach ($textFile->readToEnd() as $line) {
            $result .= $line;
        }
        Assert::assertEquals(file_get_contents($filePath), $result);
    }

    public function testGetGzFileContents()
    {
        $filepath = $this->exampleFilesFolder . 'TextFile.txt';
        $gzFilepath = $this->exampleFilesFolder . 'TextFile.txt.gz';
        $file = new TextFile($filepath);
        $gzFile = new GzFile($gzFilepath);
        $contents = '';
        foreach ($file->readToEnd() as $line) {
            $contents .= $line;
        }
        $unGzContents = '';
        foreach ($gzFile->readToEnd() as $dataBlock) {
            $unGzContents .= $dataBlock;
        }
        Assert::assertEquals($contents, $unGzContents);
    }

}