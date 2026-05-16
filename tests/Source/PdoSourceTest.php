<?php

namespace Rougin\Transcribe\Source;

use Rougin\Transcribe\Locale;

/**
 * @package Transcribe
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class PdoSourceTest extends AbstractTestcase
{
    /**
     * @return void
     */
    public function doSetUp()
    {
        $path = __DIR__ . '/../Fixture/Storage/trnscrb.db';

        $pdo = new \PDO('sqlite:' . $path);

        // Initialize with custom details ----
        $source = new PdoSource($pdo);

        $source->setTableName('word');

        $source->setTextColumn('translation');

        $source->setTypeColumn('language');

        $source->setNameColumn('text');
        // -----------------------------------

        $this->locale = new Locale($source);
    }
}
