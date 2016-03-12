<?php

namespace Rougin\Transcribe\Test\Source;

use Rougin\Transcribe\Transcribe;
use Rougin\Transcribe\Source\DirectorySource;

use PHPUnit_Framework_TestCase;

class DirectorySourceTest extends PHPUnit_Framework_TestCase
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

        $source = new DirectorySource($fixturePath . '/Languages');
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
