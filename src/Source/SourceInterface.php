<?php

namespace Rougin\Transcribe\Source;

/**
 * @package Transcribe
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
interface SourceInterface
{
    /**
     * @deprecated since ~0.4, use "words" instead.
     *
     * Returns an array of words.
     *
     * @return array<string, array<string, string>>
     */
    public function getWords();

    /**
     * Returns an array of words.
     *
     * @return array<string, array<string, string>>
     */
    public function words();
}
