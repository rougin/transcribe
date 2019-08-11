<?php

namespace Rougin\Transcribe\Source;

/**
 * Source Interface
 *
 * An interface that returns an array of words from various sources.
 *
 * @package Transcribe
 * @author  Rougin Gutib <rougingutib@gmail.com>
 */
interface SourceInterface
{
    /**
     * Returns an array of words.
     * NOTE: To be removed in v1.0.0. Use "words" instead.
     *
     * @return array
     */
    public function getWords();

    /**
     * Returns an array of words.
     *
     * @return array
     */
    public function words();
}
