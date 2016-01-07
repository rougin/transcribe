<?php

namespace Rougin\Transcribe\Source;

use FilesystemIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

/**
 * Directory Source
 *
 * Retrieves a list of words from a specified folder path.
 * 
 * @package Transcribe
 * @author  Rougin Royce Gutib <rougingutib@gmail.com>
 */
class DirectorySource implements SourceInterface
{
    /**
     * @var string
     */
    protected $path = '';

    /**
     * @param string $path
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * Returns a list of words.
     * 
     * @return array
     */
    public function getWords()
    {
        $result = [];

        $location = new RecursiveDirectoryIterator(
            $this->path,
            FilesystemIterator::SKIP_DOTS
        );

        $iterator = new RecursiveIteratorIterator(
            $location,
            RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($iterator as $path) {
            if ($path->isDir()) {
                continue;
            }

            $data = include realpath($path->__toString());
            $group = str_replace('.php', '', $path->getFilename());

            if (is_array($data)) {
                $result[$group] = $data;
            }
        }

        return $result;
    }
}
