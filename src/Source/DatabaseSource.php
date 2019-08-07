<?php

namespace Rougin\Transcribe\Source;

/**
 * Database Source
 *
 * Returns an array of words using the PHP Database Object (PDO).
 *
 * @package Transcribe
 * @author  Rougin Gutib <rougingutib@gmail.com>
 */
class DatabaseSource implements SourceInterface
{
    /**
     * @var \PDO
     */
    protected $pdo;

    /**
     * @var array
     */
    protected $table;

    /**
     * @var array
     */
    protected $words = array();

    /**
     * Initializes the source instance.
     *
     * @param \PDO  $pdo
     * @param array $table
     */
    public function __construct(\PDO $pdo, array $table)
    {
        $this->pdo = $pdo;

        $this->table = $table;
    }

    /**
     * Returns an array of words.
     * NOTE: To be removed in v1.0.0. Use "words" instead.
     *
     * @return array
     */
    public function getWords()
    {
        return $this->words();
    }

    /**
     * Returns an array of words.
     *
     * @return array
     */
    public function words()
    {
        $query = 'SELECT * FROM ' . $this->table['name'];

        $table = $this->pdo->prepare($query);

        $table->execute();

        foreach ($table->fetchAll(\PDO::FETCH_ASSOC) as $row) {
            $group = $row[$this->table['language']];

            isset($this->words[$group]) || $this->words[$group] = array();

            $text = (string) $row[$this->table['text']];

            $translation = $row[$this->table['translation']];

            $this->words[$group][$text] = $translation;
        }

        return $this->words;
    }
}
