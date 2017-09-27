<?php

namespace Tests\Unit;

use App\FileIterator;
use PHPUnit\Framework\TestCase;

/**
 * Class FileIteratorTest
 * @package Tests\Unit
 */
class FileIteratorTest extends TestCase
{
    public function testThatCanOpenFile()
    {
        $fileIterator = new FileIterator(__DIR__ . '/fixtures/file.txt');

        return $fileIterator;
    }

    /**
     * @param $fileIterator FileIterator
     * @depends testThatCanOpenFile
     */
    public function testThatCanGetKey(FileIterator $fileIterator)
    {
        $this->assertEquals(0, $fileIterator->key());

        $fileIterator->next();

        $this->assertEquals(1, $fileIterator->key());
    }

    /**
     * @param $fileIterator FileIterator
     * @depends testThatCanOpenFile
     */
    public function testThatCanRewind(FileIterator $fileIterator)
    {
        $fileIterator->seek(10);
        $fileIterator->rewind();

        $this->assertEquals(0, $fileIterator->key());
    }

    /**
     * @param $fileIterator FileIterator
     * @depends testThatCanOpenFile
     */
    public function testThatValid(FileIterator $fileIterator)
    {
        $fileIterator->seek(10);

        $this->assertTrue($fileIterator->valid());
    }

    /**
     * @param $fileIterator FileIterator
     * @depends testThatCanOpenFile
     */
    public function testNext(FileIterator $fileIterator)
    {
        $fileIterator->next();

        $this->assertTrue(1, $fileIterator->key());
    }

}