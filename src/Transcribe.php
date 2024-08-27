<?php

namespace Rougin\Transcribe;

use Rougin\Transcribe\Source\SourceInterface;

/**
 * @package Transcribe
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class Transcribe
{
    /**
     * @var array<string, mixed>
     */
    protected $dotified = array();

    /**
     * @var array<string, array<string, string>>
     */
    protected $words = array();

    /**
     * @param \Rougin\Transcribe\Source\SourceInterface $source
     */
    public function __construct(SourceInterface $source)
    {
        /** @deprecated since ~0.4, use "words" instead. */
        $this->words = $source->getWords();

        $data = $this->dotify($this->words);

        $this->dotified = (array) $data;
    }

    /**
     * Returns all words stored from the source.
     *
     * @return array<string, array<string, string>>
     */
    public function all()
    {
        return $this->words;
    }

    /**
     * Returns the specified text from an array of words.
     *
     * @param string $text
     *
     * @return string
     */
    public function get($text)
    {
        if (! isset($this->dotified[$text]))
        {
            $this->dotified[$text] = $text;
        }

        /** @var string */
        return $this->dotified[$text];
    }

    /**
     * @deprecated since ~0.4, use "get" instead.
     *
     * Returns the specified text from an array of words.
     *
     * @param string $text
     *
     * @return string
     */
    public function getText($text)
    {
        return $this->get($text);
    }

    /**
     * @deprecated since ~0.4, use "all" instead.
     *
     * Returns all words stored from the source.
     *
     * @return array<string, array<string, string>>
     */
    public function getVocabulary()
    {
        return $this->all();
    }

    /**
     * Converts the data into dot notation values.
     *
     * @param array<string, mixed> $data
     * @param array<string, mixed> $result
     * @param string               $key
     *
     * @return array<string, mixed>
     */
    protected function dotify(array $data, $result = array(), $key = '')
    {
        foreach ($data as $name => $value)
        {
            $field = (string) $key . $name;

            if (! is_array($value))
            {
                $result[$field] = $value;

                continue;
            }

            $output = $this->dotify($value, $result, $field . '.');

            $result = array_merge($result, $output);
        }

        return $result;
    }
}
