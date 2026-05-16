<?php

namespace Rougin\Transcribe\Source;

use Rougin\Transcribe\Locale;

/**
 * @package Transcribe
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class SourceCollectionTest extends AbstractTestcase
{
    /**
     * @return void
     */
    public function doSetUp()
    {
        $source = new SourceCollection;

        $path = __DIR__ . '/../Fixture/Storage/trnscrb.db';

        $pdo = new \PDO('sqlite:' . $path);

        // Initialize the "PdoSource" -----
        $pdo = new PdoSource($pdo);

        $pdo->setNameColumn('text');

        $pdo->setTableName('word');

        $pdo->setTextColumn('translation');

        $pdo->setTypeColumn('language');
        // --------------------------------

        $source->add($pdo);

        // Initialize the "FileSource" ---------
        $file = new FileSource;

        $path = __DIR__ . '/../Fixture/Locales';

        $file->addPath($path);
        // -------------------------------------

        $source->add($file);

        $this->locale = new Locale($source);
    }
}
