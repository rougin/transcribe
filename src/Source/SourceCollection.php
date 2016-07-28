<?php

namespace Rougin\Transcribe\Source;

/**
 * Source Collection
 *
 * Retrieves a list of words from multiple sources.
 * 
 * @package Transcribe
 * @author  Rougin Royce Gutib <rougingutib@gmail.com>
 */
class SourceCollection implements SourceInterface
{
    /**
     * @var array
     */
    protected $words = [];

    /**
     * Adds another source to the list of words.
     * 
     * @param  SourceInterface $source
     * @return self
     */
    public function addSource(SourceInterface $source)
    {
        $this->words = array_merge($this->words, $source->getWords());

        return $this;
    }

    /**
     * Returns a list of words.
     * 
     * @return array
     */
    public function getWords()
    {
        return $this->words;
    }
}
