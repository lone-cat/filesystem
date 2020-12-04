<?php
require dirname(__DIR__).'/vendor/autoload.php';

$fileManager = new \LoneCat\Filesystem\FileManager(__DIR__);
$file = $fileManager->getTextFile(__FILE__);
//$file->read();
var_dump($file->read());
$result = $file->readToEnd();
foreach ($result as $line) {
    var_dump($line);
}

