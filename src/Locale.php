<?php

namespace Rougin\Transcribe;

use Rougin\Transcribe\Source\SourceInterface;

/**
 * @package Transcribe
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class Locale
{
    /**
     * @var array<string, mixed>
     */
    protected $items = array();

    /**
     * @var string|null
     */
    protected $default = null;

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

        $this->items = $this->parse($words);

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
        if ($this->default)
        {
            $text = $this->default . '.' . $text;
        }

        if (! isset($this->items[$text]))
        {
            $this->items[$text] = $text;
        }

        /** @var string */
        return $this->items[$text];
    }

    /**
     * Sets the default locale to be used.
     *
     * @param string $default
     *
     * @return self
     */
    public function setDefault($default)
    {
        $this->default = $default;

        return $this;
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
            $field = $key . $name;

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
