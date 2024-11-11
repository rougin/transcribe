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
     * @var string
     */
    protected $name;

    /**
     * @var \PDO
     */
    protected $pdo;

    /**
     * @var string
     */
    protected $table;

    /**
     * @var string
     */
    protected $text;

    /**
     * @var string
     */
    protected $type;

    /**
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo)
    {
        $this->setNameColumn('name');

        $this->pdo = $pdo;

        $this->setTableName('locales');

        $this->setTextColumn('text');

        $this->setTypeColumn('type');
    }

    /**
     * @return string
     */
    public function getNameColumn()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getTableName()
    {
        return $this->table;
    }

    /**
     * @return string
     */
    public function getTextColumn()
    {
        return $this->text;
    }

    /**
     * @return string
     */
    public function getTypeColumn()
    {
        return $this->type;
    }

    /**
     * @param string $name
     *
     * @return self
     */
    public function setNameColumn($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string $table
     *
     * @return self
     */
    public function setTableName($table)
    {
        $this->table = $table;

        return $this;
    }

    /**
     * @param string $text
     *
     * @return self
     */
    public function setTextColumn($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @param string $type
     *
     * @return self
     */
    public function setTypeColumn($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return array<string, array<string, string>>
     */
    public function words()
    {
        // TODO: Be able to customize the query if needed ---
        $query = 'SELECT * FROM ' . $this->getTableName();
        // --------------------------------------------------

        $table = $this->pdo->prepare($query);

        $table->execute();

        /** @var array<string, string>[] */
        $items = $table->fetchAll(\PDO::FETCH_ASSOC);

        $words = array();

        foreach ($items as $row)
        {
            $group = $row[$this->getTypeColumn()];

            if (! isset($words[$group]))
            {
                $words[$group] = array();
            }

            $locale = $row[$this->getTextColumn()];

            $text = $row[$this->getNameColumn()];

            $words[$group][$text] = $locale;
        }

        return $words;
    }
}
