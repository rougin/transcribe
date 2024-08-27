<?php

namespace Rougin\Transcribe\Source;

/**
 * @package Transcribe
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class DirectorySource implements SourceInterface
{
    /**
     * @var \SplFileInfo[]
     */
    protected $iterator;

    /**
     * @param string $path
     */
    public function __construct($path)
    {
        $directory = new \RecursiveDirectoryIterator($path, 4096);

        /** @var \SplFileInfo[] */
        $iterator = new \RecursiveIteratorIterator($directory, 1);

        $this->iterator = $iterator;
    }

    /**
     * @deprecated since ~0.4, use "words" instead.
     *
     * Returns an array of words.
     *
     * @return array<string, array<string, string>>
     */
    public function getWords()
    {
        return $this->words();
    }

    /**
     * Returns an array of words.
     *
     * @return array<string, array<string, string>>
     */
    public function words()
    {
        $items = array();

        foreach ($this->iterator as $file)
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
