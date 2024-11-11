<?php

namespace Rougin\Transcribe\Source;

use Rougin\Transcribe\Transcribe;

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

        $this->app = new Transcribe($source);
    }
}
