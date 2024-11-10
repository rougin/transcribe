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
    protected $parsed = array();

    /**
     * @var array<string, array<string, string>>
     */
    protected $words = array();

    /**
     * @param \Rougin\Transcribe\Source\SourceInterface $source
     */
    public function __construct(SourceInterface $source)
    {
        $words = $source->words();

        $this->parsed = $this->parse($words);

        $this->words = $words;
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
        if (! isset($this->parsed[$text]))
        {
            $this->parsed[$text] = $text;
        }

        /** @var string */
        return $this->parsed[$text];
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
    protected function parse(array $data, $result = array(), $key = '')
    {
        foreach ($data as $name => $value)
        {
            $field = (string) $key . $name;

            if (! is_array($value))
            {
                $result[$field] = $value;

                continue;
            }

            $output = $this->parse($value, $result, $field . '.');

            /** @var array<string, mixed> */
            $result = array_merge($result, $output);
        }

        return $result;
    }
}
