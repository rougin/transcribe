<?php

namespace Rougin\Transcribe\Source;

use Rougin\Transcribe\Fixture\FakeFolder;
use Rougin\Transcribe\Locale;
use Rougin\Transcribe\Testcase;

/**
 * @package Transcribe
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class FileSourceTest extends Testcase
{
    /**
     * @return void
     */
    public function test_passed_if_directory_is_skipped()
    {
        // Create a new folder with "fil_PHP.php" file -----
        $folder = new FakeFolder;

        $folder->addNew('subdir');

        $data = '<?php return array("name" => "pangalan");';

        $folder->addFile('fil_PH.php', $data);
        // -------------------------------------------------

        // Initialize the locale to use -----
        $source = new FileSource;

        $source->addPath($folder->getPath());

        $locale = new Locale($source);
        // ----------------------------------

        $data = array('name' => 'pangalan');

        $expect = array('fil_PH' => $data);

        $actual = $locale->all();

        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_passed_if_non_array_locale_is_skipped()
    {
        // Create multiple files in the same fake folder -----
        $folder = new FakeFolder;

        $folder->addFile('invalid.php', '<?php return null;');

        $data = '<?php return array("hello" => "world");';

        $folder->addFile('valid.php', $data);
        // ---------------------------------------------------

        // Initialize the locale to use -----
        $source = new FileSource;

        $source->addPath($folder->getPath());

        $locale = new Locale($source);
        // ----------------------------------

        $data = array('hello' => 'world');

        $expect = array('valid' => $data);

        $actual = $locale->all();

        $this->assertEquals($expect, $actual);
    }
}
