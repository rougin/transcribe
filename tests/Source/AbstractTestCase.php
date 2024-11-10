<?php

namespace Rougin\Transcribe\Source;

use Rougin\Transcribe\Testcase;

/**
 * @package Transcribe
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class AbstractTestCase extends Testcase
{
    /**
     * @var \Rougin\Transcribe\Transcribe
     */
    protected $app;

    /**
     * Sets up the library.
     *
     * @return void
     */
    public function doSetUp()
    {
        $this->markTestSkipped('No defined SourceInterface');
    }

    /**
     * @return void
     */
    public function test_get_all_defined_words()
    {
        $expected = array('fil_PH' => array());

        $expected['fil_PH']['language'] = 'linguahe';

        $expected['fil_PH']['name'] = 'pangalan';

        $expected['fil_PH']['school'] = 'paaralan';

        $result = $this->app->all();

        $this->assertEquals($expected, $result);
    }

    /**
     * @return void
     */
    public function test_get_text_from_file()
    {
        $expected = (string) 'pangalan';

        $result = $this->app->get('fil_PH.name');

        $this->assertEquals($expected, $result);
    }

    /**
     * @return void
     */
    public function test_nonexistant_text()
    {
        $expected = (string) 'test';

        $result = $this->app->get('test');

        $this->assertEquals($expected, $result);
    }
}
