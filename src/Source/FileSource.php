<?php

namespace Rougin\Transcribe\Source;

use FilesystemIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

/**
 * @package Transcribe
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class FileSource implements SourceInterface
{
    /**
     * @var string[]
     */
    protected $paths = array();

    /**
     * @param string $path
     *
     * @return self
     */
    public function addPath($path)
    {
        $this->paths[] = $path;

        return $this;
    }

    /**
     * @return array<string, array<string, string>>
     */
    public function words()
    {
        $files = $this->getFiles();

        $words = array();

        foreach ($files as $file)
        {
            $filename = $file->getFilename();

            /** @var string */
            $realpath = $file->getRealPath();

            $group = str_replace('.php', '', $filename);

            if (! $file->isDir())
            {
                $words[$group] = require $realpath;
            }
        }

        return $words;
    }

    /**
     * @return \SplFileInfo[]
     */
    protected function getFiles()
    {
        $files = array();

        $skip = FilesystemIterator::SKIP_DOTS;

        $first = RecursiveIteratorIterator::SELF_FIRST;

        foreach ($this->paths as $path)
        {
            $paths = new RecursiveDirectoryIterator($path, $skip);

            /** @var \SplFileInfo[] */
            $items = new RecursiveIteratorIterator($paths, $first);

            foreach ($items as $item)
            {
                $files[] = $item;
            }
        }

        return $files;
    }
}
