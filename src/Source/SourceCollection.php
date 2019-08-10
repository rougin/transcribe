<?php

namespace Rougin\Transcribe\Source;

/**
 * Source Collection
 *
 * Returns an array of words from multiple sources.
 *
 * @package Transcribe
 * @author  Rougin Gutib <rougingutib@gmail.com>
 */
class SourceCollection implements SourceInterface
{
    /**
     * @var \Rougin\Transcribe\Source\SourceInterface[]
     */
    protected $sources = array();

    /**
     * Initializes the source instance.
     *
     * @param \Rougin\Transcribe\Source\SourceInterface[] $sources
     */
    public function __construct(array $sources = array())
    {
        $this->sources = $sources;
    }

    /**
     * Add a SourceInterface instance to the collection.
     *
     * @param  \Rougin\Transcribe\Source\SourceInterface $source
     * @return self
     */
    public function add(SourceInterface $source)
    {
        $this->sources[] = $source;

        return $this;
    }

    /**
     * Add a SourceInterface instance to the collection.
     * NOTE: To be removed in v1.0.0. Use "add" instead.
     *
     * @param  \Rougin\Transcribe\Source\SourceInterface $source
     * @return self
     */
    public function addSource(SourceInterface $source)
    {
        return $this->add($source);
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
        $words = array();

        foreach ((array) $this->sources as $source) {
            // Note: Use $source->words() in v1.0.0.
            $addition = (array) $source->getWords();

            $words = array_merge($words, $addition);
        }

        return $words;
    }
}
