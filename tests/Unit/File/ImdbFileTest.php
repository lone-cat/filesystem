<?php

namespace LoneCat\Filesystem\Tests\Unit\File;

use LoneCat\Filesystem\File\CsvFile;
use LoneCat\Filesystem\File\ImdbFile;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class ImdbFileTest extends TestCase
{

    private $exampleFilesFolder;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->exampleFilesFolder = realpath(dirname(dirname(__DIR__))) . '/ExampleFiles/';
    }

    public function testHeaders()
    {
        $filename = $this->exampleFilesFolder . 'ImdbFile.tsv';
        $tsvFile = new ImdbFile($filename);
        $headers = [
            'tconst',
            'titleType',
            'primaryTitle',
            'originalTitle',
            'isAdult',
            'startYear',
            'endYear',
            'runtimeMinutes',
            'genres',
        ];
        Assert::assertEquals($headers, $tsvFile->getHeaders());
    }

    public function testDataWithHeaders()
    {
        $filename = $this->exampleFilesFolder . 'ImdbFile.tsv';
        $tsvFile = new ImdbFile($filename);
        $expected = [
            [
                'tconst' => 'tt10233364',
                'titleType' => 'tvEpisode',
                'primaryTitle' => '"Rolling in the Deep Dish',
                'originalTitle' => '"Rolling in the Deep Dish',
                'isAdult' => '0',
                'startYear' => '2019',
                'endYear' => '\N',
                'runtimeMinutes' => '\N',
                'genres' => 'Reality-TV',
            ],
        ];
        $real = [];

        foreach ($tsvFile->readToEnd() as $data) {
            $real[] = $data;
        }

        Assert::assertEquals($expected, $real);
    }

    public function testDataWithoutHeaders()
    {
        $filename = $this->exampleFilesFolder . 'ImdbFile.tsv';
        $tsvFile = new ImdbFile($filename, "\t", false);
        $expected = [
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
        $real = [];

        foreach ($tsvFile->readToEnd() as $data) {
            $real[] = $data;
        }

        Assert::assertEquals($expected, $real);
    }

}