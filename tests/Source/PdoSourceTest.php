<?php

namespace Rougin\Transcribe\Source;

use Rougin\Transcribe\Locale;
use Rougin\Transcribe\Transcribe;

/**
 * @package Transcribe
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class PdoSourceTest extends AbstractTestCase
{
    /**
     * @return void
     */
    public function doSetUp()
    {
        $path = __DIR__ . '/../Fixture/Storage';

        $pdo = new \PDO('sqlite:' . $path . '/trnscrb.db');

        $source = new PdoSource($pdo);

        $source->setTableName('word');

        $source->setTextColumn('translation');

        $source->setTypeColumn('language');

        $source->setNameColumn('text');

        $this->locale = new Locale($source);
    }
}
