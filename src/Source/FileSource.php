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
            if ($file->isDir())
            {
                continue;
            }

            $name = $file->getFilename();

            $group = str_replace('.php', '', $name);

            // Extract data from the file ---
            $data = array();

            if ($path = $file->getRealPath())
            {
                $data = require $path;
            }
            // ------------------------------

            if (! is_array($data))
            {
                continue;
            }

            foreach ($data as $key => $text)
            {
                if (is_string($key) && is_string($text))
                {
                    $words[$group][$key] = $text;
                }
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

        $mode = RecursiveIteratorIterator::SELF_FIRST;

        $skip = FilesystemIterator::SKIP_DOTS;

        foreach ($this->paths as $path)
        {
            $paths = new RecursiveDirectoryIterator($path, $skip);

            $items = new RecursiveIteratorIterator($paths, $mode);

            foreach ($items as $item)
            {
                if ($item instanceof \SplFileInfo)
                {
                    $files[] = $item;
                }
            }
        }

        return $files;
    }
}
