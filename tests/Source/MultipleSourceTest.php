<?php

namespace Rougin\Transcribe\Test\Source;

use Rougin\Transcribe\Transcribe;
use Rougin\Transcribe\Source\DatabaseSource;
use Rougin\Transcribe\Source\MultipleSource;
use Rougin\Transcribe\Source\DirectorySource;

use PDO;
use PHPUnit_Framework_TestCase;

class MultipleSourceTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \Rougin\Transcribe\Transcribe
     */
    protected $transcribe;

    /**
     * Sets up the library.
     *
     * @return void
     */
    public function setUp()
    {
        $fixturePath = str_replace('Source', 'Fixture', __DIR__);

        $pdo = new PDO('sqlite:' . $fixturePath . '/database.db');

        $tableProperties = [
            'name'        => 'word',
            'language'    => 'language',
            'text'        => 'text',
            'translation' => 'translation',
        ];

        $source = new MultipleSource;
        $database = new DatabaseSource($pdo, $tableProperties);
        $directory = new DirectorySource($fixturePath . '/Languages');

        $source
            ->addSource($database)
            ->addSource($directory);

        $this->transcribe = new Transcribe($source);
    }

    /**
     * Checks if the specified text is retrieved properly.
     * 
     * @return void
     */
    public function testGetText()
    {
        $text = 'pangalan';

        $this->assertEquals($text, $this->transcribe->getText('fil_PH.name'));
    }

    /**
     * Checks if the specified texts is equal to getVocabulary().
     * 
     * @return void
     */
    public function testGetVocabulary()
    {
        $vocabulary = [
            'fil_PH' => [
                'name'     => 'pangalan',
                'language' => 'linguahe',
                'school'   => 'paaralan',
            ]
        ];

        $this->assertEquals($vocabulary, $this->transcribe->getVocabulary());
    }
}
