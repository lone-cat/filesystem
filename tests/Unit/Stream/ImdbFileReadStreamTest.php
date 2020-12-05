<?php

namespace LoneCat\Filesystem\Tests\Unit\Stream;

use LoneCat\Filesystem\Exception\Stream\StreamNonExistentFileException;
use LoneCat\Filesystem\Stream\CsvFileReadStream;
use LoneCat\Filesystem\Stream\ImdbFileReadStream;
use LoneCat\Filesystem\Stream\TextFileReadStream;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class ImdbFileReadStreamTest extends TestCase
{
    private $exampleFilesFolder;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->exampleFilesFolder = realpath(dirname(dirname(__DIR__))) . '/ExampleFiles/';
    }

    public function testReadAll()
    {
        $filename = $this->exampleFilesFolder . 'ImdbFile.tsv';
        $stream = new ImdbFileReadStream($filename, "\t", false);
        $result = [];
        foreach ($stream->readAll() as $line) {
            $result[] = $line;
        }

        $expectedResult = [
            [
                'tconst',
                'titleType',
                'primaryTitle',
                'originalTitle',
                'isAdult',
                'startYear',
                'endYear',
                'runtimeMinutes',
                'genres',
            ],
            [
                'tt10233364',
                'tvEpisode',
                '"Rolling in the Deep Dish',
                '"Rolling in the Deep Dish',
                '0',
                '2019',
                '\N',
                '\N',
                'Reality-TV',
            ],
        ];
        Assert::assertEquals($expectedResult, $result);
        $stream->close();
    }
}