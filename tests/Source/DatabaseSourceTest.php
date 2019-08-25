<?php

namespace Rougin\Transcribe\Source;

use Rougin\Transcribe\Source\DatabaseSource;
use Rougin\Transcribe\Transcribe;

/**
 * Database Source Test
 *
 * @package Transcribe
 * @author  Rougin Gutib <rougingutib@gmail.com>
 */
class DatabaseSourceTest extends AbstractTestCase
{
    /**
     * Sets up the library.
     *
     * @return void
     */
    public function setUp()
    {
        $path = str_replace('Source', 'Fixture', __DIR__);

        $pdo = new \PDO('sqlite:' . $path . '/database.db');

        $table = array('name' => 'word');

        $table['language'] = 'language';

        $table['text'] = (string) 'text';

        $table['translation'] = 'translation';

        $source = new DatabaseSource($pdo, $table);

        $this->transcribe = new Transcribe($source);
    }
}
