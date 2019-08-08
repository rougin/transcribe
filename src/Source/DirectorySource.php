<?php

namespace Rougin\Transcribe\Source;

use FilesystemIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

/**
 * Directory Source
 *
 * Returns an array of words from a specified directory path.
 *
 * @package Transcribe
 * @author  Rougin Gutib <rougingutib@gmail.com>
 */
class DirectorySource implements SourceInterface
{
    /**
     * @var \RecursiveIteratorIterator
     */
    protected $iterator;

    /**
     * Intializes the source instance.
     *
     * @param string $path
     */
    public function __construct($path)
    {
        $directory = new \RecursiveDirectoryIterator($path, 4096);

        $iterator = new \RecursiveIteratorIterator($directory, 1);

        $this->iterator = $iterator;
    }

    /**
     * Returns an array of words.
     * NOTE: To be removed in v1.0.0. Use "words" instead.
     *
     * @return array
     */
    public function getWords()
    {
        return $this->words();
    }

    /**
     * Returns an array of words.
     *
     * @return array
     */
    public function words()
    {
        $result = array();

        foreach ($this->iterator as $file) {
            $filename = (string) $file->getFilename();

            $realpath = (string) $file->getRealPath();

            $group = str_replace('.php', '', $filename);

            if ($file->isDir() === false) {
                $data = require (string) $realpath;

                $result[$group] = (array) $data;
            }
        }

        return $result;
    }
}
