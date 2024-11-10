<?php

namespace Rougin\Transcribe\Source;

/**
 * @package Transcribe
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class PdoSource implements SourceInterface
{
    /**
     * @var \PDO
     */
    protected $pdo;

    /**
     * @var array<string, string>
     */
    protected $table;

    /**
     * @var array<string, array<string, string>>
     */
    protected $words = array();

    /**
     * @param \PDO                  $pdo
     * @param array<string, string> $table
     */
    public function __construct(\PDO $pdo, array $table)
    {
        $this->pdo = $pdo;

        $this->table = $table;
    }

    /**
     * Returns an array of words.
     *
     * @return array<string, array<string, string>>
     */
    public function words()
    {
        $query = 'SELECT * FROM ' . $this->table['name'];

        $table = $this->pdo->prepare($query);

        $table->execute();

        $fields = $this->table;

        /** @var array<string, string>[] */
        $items = $table->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($items as $row)
        {
            $group = $row[$fields['language']];

            if (! isset($this->words[$group]))
            {
                $this->words[$group] = array();
            }

            $translation = $row[$fields['translation']];

            $text = (string) $row[$fields['text']];

            $this->words[$group][$text] = $translation;
        }

        return $this->words;
    }
}
