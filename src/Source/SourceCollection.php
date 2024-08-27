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
     * @deprecated since ~0.4, use "add" instead.
     *
     * Adds a SourceInterface to the collection.
     *
     * @param \Rougin\Transcribe\Source\SourceInterface $source
     *
     * @return self
     */
    public function addSource(SourceInterface $source)
    {
        return $this->add($source);
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
        $words = array();

        foreach ($this->sources as $source)
        {
            /** @deprecated since ~0.4, use "words" instead. */
            $addition = (array) $source->getWords();

            $words = array_merge($words, $addition);
        }

        return $words;
    }
}
