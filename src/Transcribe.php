<?php

namespace Rougin\Transcribe;

use Tebru\MultiArray;
use Rougin\Transcribe\Source\SourceInterface;

/**
 * Transcribe
 *
 * An easy-to-use localization library for PHP.
 *
 * @package Transcribe
 * @author  Rougin Royce Gutib <rougingutib@gmail.com>
 */
class Transcribe
{
    /**
     * @var array
     */
    protected $dotified = array();

    /**
     * @var array
     */
    protected $words = array();

    /**
     * Initializes the Transcribe instance.
     *
     * @param \Rougin\Transcribe\Source\SourceInterface $source
     */
    public function __construct(SourceInterface $source)
    {
        // Note: Use $source->words() in v1.0.0.
        $this->words = $source->getWords();

        $this->dotified = $this->dotify($this->words);
    }

    /**
     * Returns all words stored from the source.
     *
     * @return array
     */
    public function all()
    {
        return $this->words;
    }

    /**
     * Returns the specified text from an array of words.
     * NOTE: To be removed in v1.0.0. Use "get" instead.
     *
     * @param  string $text
     * @return string
     */
    public function get($text)
    {
        if (! isset($this->dotified[$text])) {
            $this->dotified[$text] = $text;
        }

        return $this->dotified[$text];
    }

    /**
     * Returns the specified text from an array of words.
     * NOTE: To be removed in v1.0.0. Use "get" instead.
     *
     * @param  string $text
     * @return string
     */
    public function getText($text)
    {
        return $this->get($text);
    }

    /**
     * Returns all words stored from the source.
     * NOTE: To be removed in v1.0.0. Use "all" instead.
     *
     * @return array
     */
    public function getVocabulary()
    {
        return $this->all();
    }

    /**
     * Converts the data into dot notation values.
     *
     * @param  array  $data
     * @param  array  $result
     * @param  string $key
     * @return array
     */
    protected function dotify(array $data, $result = array(), $key = '')
    {
        foreach ((array) $data as $name => $value) {
            if (is_array($value) === true) {
                $new = (string) $key . $name . '.';

                $array = $this->dotify($value, $result, $new);

                $result = array_merge($result, $array);
            }

            is_array($value) || $result[$key . $name] = $value;
        }

        return $result;
    }
}
