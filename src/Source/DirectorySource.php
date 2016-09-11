<?php

namespace Rougin\Transcribe\Source;

use FilesystemIterator;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;

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
     * @var \RecursiveIteratorIterator
     */
    protected $iterator;

    /**
     * @param string $path
     */
    public function __construct($path)
    {
        $this->iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
        );
    }

    /**
     * Returns a list of words.
     *
     * @return array
     */
    public function getWords()
    {
        $result = [];

        foreach ($this->iterator as $path) {
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
