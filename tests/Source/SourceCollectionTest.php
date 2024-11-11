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
        $source = new SourceCollection;

        // Add the PdoSource class ------------------------
        $path = __DIR__ . '/../Fixture/Storage';

        $pdo = new \PDO('sqlite:' . $path . '/trnscrb.db');

        $pdo = new PdoSource($pdo);

        $pdo->setTypeColumn('language');

        $pdo->setTextColumn('translation');

        $pdo->setNameColumn('text');

        $source->add($pdo->setTableName('word'));
        // ------------------------------------------------

        // Add the FileSource class ------------
        $file = new FileSource;

        $path = __DIR__ . '/../Fixture/Locales';

        $source->add($file->addPath($path));
        // -------------------------------------

        $this->app = new Transcribe($source);
    }
}
