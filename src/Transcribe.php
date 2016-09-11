<?php

namespace Rougin\Transcribe;

use Tebru\MultiArray;
use Rougin\Transcribe\Source\SourceInterface;

/**
 * Transcribe
 *
 * Yet another language library for PHP.
 *
 * @package Transcribe
 * @author  Rougin Royce Gutib <rougingutib@gmail.com>
 */
class Transcribe
{
    /**
     * @var \Rougin\Transcribe\Source\SourceInterface
     */
    protected $source;

    /**
     * List of words.
     *
     * @var array
     */
    protected $vocabulary = [];

    /**
     * @param SourceInterface $source
     */
    public function __construct(SourceInterface $source)
    {
        $this->source     = $source;
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
        $multiArray = new MultiArray($this->vocabulary);
        $result     = $multiArray->get($string);

        return (is_string($result)) ? $result : $string;
    }

    /**
     * Returns all words stored from the vocabulary.
     *
     * @return array
     */
    public function getVocabulary()
    {
        return $this->vocabulary;
    }
}
