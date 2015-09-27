<?php

namespace Rougin\Transcribe\Source;

use PDO;

/**
 * Database Source
 *
 * Retrieves a list of words via PHP Database Object
 * 
 * @package Transcribe
 * @author  Rougin Royce Gutib <rougingutib@gmail.com>
 */
class DatabaseSource implements SourceInterface
{
    protected $pdo;
    protected $table;

    /**
     * @param PDO   $pdo
     * @param array $table
     */
    public function __construct(PDO $pdo, array $table)
    {
        $this->pdo = $pdo;
        $this->table = $table;
    }

    /**
     * Returns a list of words.
     * 
     * @return array
     */
    public function getWords()
    {
        $words = [];

        $language = $this->table['language'];
        $query = 'SELECT * FROM ' . $this->table['name'];
        $text = $this->table['text'];
        $translation = $this->table['translation'];

        $table = $this->pdo->prepare($query);
        $table->execute();

        foreach ($table->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $words[$row[$language]][$row[$text]] = $row[$translation];
        }

        return $words;
    }
}
