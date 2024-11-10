<?php

namespace Rougin\Transcribe\Source;

/**
 * @package Transcribe
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class FileSource implements SourceInterface
{
    /**
     * @var \SplFileInfo[]
     */
    protected $items;

    /**
     * @param string $path
     */
    public function __construct($path)
    {
        $files = new \RecursiveDirectoryIterator($path, 4096);

        /** @var \SplFileInfo[] */
        $items = new \RecursiveIteratorIterator($files, 1);

        $this->items = $items;
    }

    /**
     * Returns an array of words.
     *
     * @return array<string, array<string, string>>
     */
    public function words()
    {
        $items = array();

        foreach ($this->items as $file)
        {
            $filename = $file->getFilename();

            /** @var string */
            $realpath = $file->getRealPath();

            $group = str_replace('.php', '', $filename);

            if (! $file->isDir())
            {
                $items[$group] = require $realpath;
            }
        }

        return $items;
    }
}
