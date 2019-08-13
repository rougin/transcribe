<?php

namespace Rougin\Transcribe\Source;

/**
 * Abstract Test Case
 *
 * @package Transcribe
 * @author  Rougin Gutib <rougingutib@gmail.com>
 */
class AbstractTestCase extends \PHPUnit_Framework_TestCase
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
        $this->markTestSkipped('No defined SourceInterface');
    }

    /**
     * Tests Transcribe::getText.
     *
     * @return void
     */
    public function testGetTextMethod()
    {
        $expected = (string) 'pangalan';

        $result = $this->transcribe->getText('fil_PH.name');

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests Transcribe::getText with nonexistent text.
     *
     * @return void
     */
    public function testGetTextMethodWithNonexistentText()
    {
        $expected = (string) 'test';

        $result = $this->transcribe->getText('test');

        $this->assertEquals($expected, $result);
    }

    /**
     * Tests Transcribe::getVocabulary.
     *
     * @return void
     */
    public function testGetVocabularyMethod()
    {
        $expected = array('fil_PH' => array());

        $expected['fil_PH']['language'] = 'linguahe';

        $expected['fil_PH']['name'] = 'pangalan';

        $expected['fil_PH']['school'] = 'paaralan';

        $result = $this->transcribe->getVocabulary();

        $this->assertEquals($expected, $result);
    }
}
