<?php

namespace Rougin\Transcribe\Source;

use Rougin\Transcribe\Source\DatabaseSource;
use Rougin\Transcribe\Source\DirectorySource;
use Rougin\Transcribe\Source\MultipleSource;
use Rougin\Transcribe\Transcribe;

/**
 * Source Collection Test
 *
 * @package Transcribe
 * @author  Rougin Gutib <rougingutib@gmail.com>
 */
class SourceCollectionTest extends AbstractTestCase
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
        $path = str_replace('Source', 'Fixture', __DIR__);

        $pdo = new \PDO('sqlite:' . $path . '/database.db');

        $table = array('name' => 'word');

        $table['language'] = 'language';

        $table['text'] = (string) 'text';

        $table['translation'] = 'translation';

        $source = new SourceCollection;

        $source->addSource(new DatabaseSource($pdo, $table));

        $source->addSource(new DirectorySource($path . '/Locales'));

        $this->transcribe = new Transcribe($source);
    }
}
