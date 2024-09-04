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
     * Returns an array of words.
     *
     * @return array<string, array<string, string>>
     */
    public function words();
}
