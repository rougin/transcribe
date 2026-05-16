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
     * @var array<string, string>
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
     * @param array<string, array<string, string>> $data
     *
     * @return array<string, string>
     */
    protected function parse(array $data)
    {
        $rows = array();

        $item = array('data' => $data, 'key' => '');

        $stack = array($item);

        while ($stack)
        {
            $current = array_pop($stack);

            $items = $current['data'];

            $prefix = $current['key'];

            foreach ($items as $name => $value)
            {
                $field = $prefix . $name;

                if (! is_array($value))
                {
                    $rows[$field] = $value;

                    continue;
                }

                // Put item to stack for compute ---
                $item = array('data' => $value);

                $item['key'] = $field . '.';

                $stack[] = $item;
                // ---------------------------------
            }
        }

        return $rows;
    }
}
