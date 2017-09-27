<?php
require_once __DIR__ . '/vendor/autoload.php';


$fileIterator = new \App\FileIterator(__DIR__.'/tests/Unit/fixtures/file.txt');

$fileIterator->seek(10);



echo $fileIterator->current();
echo $fileIterator->key();