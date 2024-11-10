<?php

namespace Rougin\Transcribe\Source;

use Rougin\Transcribe\Transcribe;

/**
 * @package Transcribe
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class SourceCollectionTest extends AbstractTestCase
{
    /**
     * @return void
     */
    public function doSetUp()
    {
        $path = str_replace('Source', 'Fixture', __DIR__);

        $pdo = new \PDO('sqlite:' . $path . '/database.db');

        $table = array('name' => 'word');

        $table['language'] = 'language';

        $table['text'] = (string) 'text';

        $table['translation'] = 'translation';

        $source = new SourceCollection;

        $source->add(new PdoSource($pdo, $table));

        $source->add(new FileSource($path . '/Locales'));

        $this->app = new Transcribe($source);
    }
}
