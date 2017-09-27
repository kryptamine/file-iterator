<?php

namespace App;

use SeekableIterator;

/**
 * Class FileIterator
 * @package App
 */
class FileIterator implements SeekableIterator
{
    const ONE_BYTE = 1;

    /**
     * @var int
     */
    private $position = 0;

    /**
     * @var resource
     */
    private $handler;

    /**
     * FileIterator constructor.
     *
     * @param string $path
     *
     * @throws \Exception
     */
    public function __construct(string $path)
    {
        if (!file_exists($path)) {
            throw new \Exception('File doesn\'t exist');
        }

        $this->handler  = fopen($path, 'r');
    }

    /**
     * @return int
     */
    public function key(): int
    {
        return (int)$this->position;
    }

    /**
     * @return int
     */
    public function next(): int
    {
        ++$this->position;

        return $this->position;
    }

    /**
     * @param int $position
     *
     * @return int
     */
    public function seek($position)
    {
        $this->position = $position;

        if (!$this->valid()) {
            throw new \OutOfBoundsException("invalid seek position ($position)");
        }

        fseek($this->handler, $this->position, SEEK_SET);
    }

    /**
     * @return bool
     */
    public function rewind()
    {
        $this->position = 0;

        rewind($this->handler);
    }

    /**
     * @return string
     */
    public function current()
    {
        $this->seek($this->position);

        return fread($this->handler, static::ONE_BYTE);
    }

    /**
     * @return bool
     */
    public function valid(): bool
    {
        return !feof($this->handler);
    }

    public function __destruct()
    {
        if ($this->handler) {
            fclose($this->handler);
        }
    }
}