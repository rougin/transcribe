<?php

namespace Rougin\Transcribe\Fixture;

use FilesystemIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

/**
 * @package Transcribe
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class FakeFolder
{
    /**
     * @var string
     */
    protected $root = '';

    public function __construct()
    {
        $temp = sys_get_temp_dir();

        $this->root = $temp . '/trnscrb_' . uniqid();

        mkdir($this->root);
    }

    public function __destruct()
    {
        if (! is_dir($this->root))
        {
            return;
        }

        $root = $this->root;

        // Initialize the directory iterator ---------------
        $mode = FilesystemIterator::SKIP_DOTS;

        $dir = new RecursiveDirectoryIterator($root, $mode);
        // -------------------------------------------------

        // Initialize the iterator for handling files ------
        $mode = RecursiveIteratorIterator::CHILD_FIRST;

        $items = new RecursiveIteratorIterator($dir, $mode);
        // -------------------------------------------------

        foreach ($items as $item)
        {
            if ($item instanceof \SplFileInfo)
            {
                $item->isDir() ? rmdir($item) : unlink($item);
            }
        }

        rmdir($this->root);
    }

    /**
     * @param string $name
     * @param string $data
     *
     * @return self
     */
    public function addFile($name, $data)
    {
        $file = $this->root . '/' . $name;

        file_put_contents($file, $data);

        return $this;
    }

    /**
     * @param string $name
     *
     * @return self
     */
    public function addNew($name)
    {
        mkdir($this->root . '/' . $name);

        return $this;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->root;
    }
}
