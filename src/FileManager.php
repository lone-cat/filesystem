<?php

namespace LoneCat\Filesystem;

use Exception;
use LoneCat\Filesystem\File\BinaryFile;
use LoneCat\Filesystem\File\File;
use LoneCat\Filesystem\File\GzFile;
use LoneCat\Filesystem\File\TextFile;

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

    public function getBinaryFile(string $filename): BinaryFile
    {
        $this->fileExistenceCheck($filename);
        return new BinaryFile($filename);
    }

    public function getTextFile(string $filename): TextFile
    {
        $this->fileExistenceCheck($filename);
        return new TextFile($filename);
    }

    public function getGzArchiveFile(string $filename): GzFile
    {
        $this->fileExistenceCheck($filename);
        return new GzFile($filename);
    }

    public function createBinaryFile(string $filename): BinaryFile
    {
        $this->fileNonExistenceCheck($filename);
        $this->folderExistenceCheck(dirname($filename));
        $file = new BinaryFile($filename);
        $file->prepareToWrite();
        $file->closeStream();
        return $file;
    }

    public function createTextFile(string $filename): TextFile
    {
        $this->fileNonExistenceCheck($filename);
        $this->folderExistenceCheck(dirname($filename));
        $file = new TextFile($filename);
        $file->prepareToWrite();
        $file->closeStream();
        return $file;
    }

    public function createTemporaryFile(): File
    {
        $tmpFile = tempnam($this->tmpPath, 'tmp-file-');

        if (!$tmpFile) {
            throw new Exception('Impossible to create temporary file');
        }

        return $this->createBinaryFile($tmpFile);
    }

    public function unpack(GzFile $gzFile, BinaryFile $binaryFile)
    {
        $binaryFile->writeFileDataFromIterator($gzFile->iterateFileData());
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