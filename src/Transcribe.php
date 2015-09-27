<?php

namespace Rougin\Transcribe;

use Rougin\Transcribe\Source\SourceInterface;

/**
 * Transcribe
 *
 * Yet another language library for PHP
 *
 * @package Transcribe
 * @author  Rougin Royce Gutib <rougingutib@gmail.com>
 */
class Transcribe
{
    protected $source;
    protected $vocabulary = [];

    /**
     * @param SourceInterface $source
     */
    public function __construct(SourceInterface $source)
    {
        $this->source = $source;
        $this->vocabulary = $source->getWords();
    }

    /**
     * Gets the specified text from the list of defined words in the file.
     * 
     * @param  string $string
     * @return string
     */
    public function getText($string = '')
    {
        $group = '';

        if (strpos($string, '.') !== FALSE) {
            list($group, $string) = explode('.', $string);
        }

        if (! isset($this->vocabulary[$group][$string])) {
            return $string;
        }

        return $this->vocabulary[$group][$string];
    }

    /**
     * Gets all words stored from the vocabulary.
     * 
     * @return array
     */
    public function getVocabulary()
    {
        return $this->vocabulary;
    }
}
