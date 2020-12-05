<?php

namespace LoneCat\Filesystem;

use Exception;
use LoneCat\Filesystem\File\BinaryFile;
use LoneCat\Filesystem\File\CsvFile;
use LoneCat\Filesystem\File\File;
use LoneCat\Filesystem\File\GzFile;
use LoneCat\Filesystem\File\TextFile;
use LoneCat\Filesystem\File\TsvFile;

class FileManager
{

    private string $tmpPath;

    public function __construct(string $tmpPath)
    {
        $this->tmpPath = $tmpPath;
    }

    public function getTempFolder(): string
    {
        return $this->tmpPath;
    }

    public function getBinaryFile(string $filename, int $bufferLength = 4096): BinaryFile
    {
        $this->fileExistenceCheck($filename);
        return new BinaryFile($filename, $bufferLength);
    }

    public function getTextFile(string $filename): TextFile
    {
        $this->fileExistenceCheck($filename);
        return new TextFile($filename);
    }

    public function getCsvFile(string $filename): CsvFile
    {
        $this->fileExistenceCheck($filename);
        return new CsvFile($filename);
    }

    public function getTsvFile(string $filename): TsvFile
    {
        $this->fileExistenceCheck($filename);
        return new TsvFile($filename);
    }

    public function getGzArchiveFile(string $filename, int $bufferLength = 4096): GzFile
    {
        $this->fileExistenceCheck($filename);
        return new GzFile($filename, $bufferLength);
    }

    public function createBinaryFile(string $filename, int $bufferLength = 4096): BinaryFile
    {
        $this->fileNonExistenceCheck($filename);
        $this->folderExistenceCheck(dirname($filename));
        return new BinaryFile($filename, $bufferLength);
    }

    public function createTextFile(string $filename): TextFile
    {
        $this->fileNonExistenceCheck($filename);
        $this->folderExistenceCheck(dirname($filename));
        return new TextFile($filename);
    }

    public function createTemporaryFile(): File
    {
        $tmpFile = tempnam($this->tmpPath, 'tmp-file-');

        if (!$tmpFile) {
            throw new Exception('Impossible to create temporary file');
        }

        return $this->getBinaryFile($tmpFile);
    }

    public function unpack(GzFile $gzFile, BinaryFile $binaryFile)
    {
        $binaryFile->writeFileDataFromIterable($gzFile->readToEnd());
    }

    public function deleteFile(File $file)
    {
        $fileName = $file->getFileName();
        $file->closeStream();
        if (file_exists($fileName)) {
            unlink($fileName);
        }
    }


    private function fileExistenceCheck(string $filename): void
    {
        if (!file_exists($filename)) {
            throw new Exception('Non existent file!');
        }
    }

    private function fileNonExistenceCheck(string $filename): void
    {
        if (file_exists($filename)) {
            throw new Exception('Existent file!');
        }
    }

    private function folderExistenceCheck(string $folder): void
    {
        if (!is_dir($folder)) {
            throw new Exception('Folder doesnt exist!');
        }
    }

}