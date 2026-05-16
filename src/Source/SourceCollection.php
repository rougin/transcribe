<?php

namespace Rougin\Transcribe\Source;

/**
 * @package Transcribe
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class SourceCollection implements SourceInterface
{
    /**
     * @var \Rougin\Transcribe\Source\SourceInterface[]
     */
    protected $sources = array();

    /**
     * @param \Rougin\Transcribe\Source\SourceInterface[] $sources
     */
    public function __construct(array $sources = array())
    {
        $this->sources = $sources;
    }

    /**
     * Adds a SourceInterface to the collection.
     *
     * @param \Rougin\Transcribe\Source\SourceInterface $source
     *
     * @return self
     */
    public function add(SourceInterface $source)
    {
        $this->sources[] = $source;

        return $this;
    }

    /**
     * Returns an array of words.
     *
     * @return array<string, array<string, string>>
     */
    public function words()
    {
        $words = array();

        foreach ($this->sources as $item)
        {
            $items = $item->words();

            foreach ($items as $group => $texts)
            {
                $words[$group] = $texts;
            }
        }

        return $words;
    }
}
