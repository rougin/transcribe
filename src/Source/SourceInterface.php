<?php

namespace Rougin\Transcribe\Source;

/**
 * Source Interface
 *
 * An interface that gets a list of words from various sources
 *
 * @package Transcribe
 * @author  Rougin Royce Gutib <rougingutib@gmail.com>
 */
interface SourceInterface
{
    /**
     * Returns a list of words.
     * 
     * @return array
     */
    public function getWords();
}
