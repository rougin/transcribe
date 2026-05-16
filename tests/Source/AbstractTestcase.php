<?php

namespace Rougin\Transcribe\Source;

use Rougin\Transcribe\Testcase;

/**
 * @package Transcribe
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class AbstractTestcase extends Testcase
{
    /**
     * @var \Rougin\Transcribe\Locale
     */
    protected $locale;

    /**
     * @return void
     */
    public function test_passed_if_all_returns_words()
    {
        // Initialize the sample data -----
        $data = array();

        $data['language'] = 'linguahe';
        $data['name'] = 'pangalan';
        $data['school'] = 'paaralan';

        $expect = array('fil_PH' => $data);
        // --------------------------------

        $actual = $this->locale->all();

        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_passed_if_get_falls_back_to_key()
    {
        $actual = $this->locale->get('test');

        $this->assertEquals('test', $actual);
    }

    /**
     * @return void
     */
    public function test_passed_if_get_returns_text()
    {
        $actual = $this->locale->get('fil_PH.name');

        $this->assertEquals('pangalan', $actual);
    }

    /**
     * @return void
     */
    public function test_passed_if_set_default_prepends_group()
    {
        $this->locale->setDefault('fil_PH');

        $actual = $this->locale->get('name');

        $this->assertEquals('pangalan', $actual);
    }

    /**
     * Sets up the library.
     *
     * @return void
     */
    protected function doSetUp()
    {
        $this->markTestSkipped('No defined SourceInterface');
    }
}
