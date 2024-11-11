<?php

namespace Rougin\Transcribe\Source;

use Rougin\Transcribe\Locale;

/**
 * @package Transcribe
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class FileSourceTest extends AbstractTestCase
{
    /**
     * @return void
     */
    public function doSetUp()
    {
        $source = new FileSource;

        $path = __DIR__ . '/../Fixture/Locales';

        $source->addPath($path);

        $this->locale = new Locale($source);
    }
}
