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
        $path = str_replace('Source', 'Fixture', __DIR__);

        $source = new FileSource($path . '/Locales');

        $this->app = new Transcribe($source);
    }
}
