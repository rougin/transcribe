<?php

namespace Rougin\Transcribe\Source;

use Rougin\Transcribe\Transcribe;

/**
 * Directory Source Test
 *
 * @package Transcribe
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class DirectorySourceTest extends AbstractTestCase
{
    /**
     * @var \Rougin\Transcribe\Transcribe
     */
    protected $transcribe;

    /**
     * @return void
     */
    public function doSetUp()
    {
        $path = str_replace('Source', 'Fixture', __DIR__);

        $source = new DirectorySource($path . '/Locales');

        $this->transcribe = new Transcribe($source);
    }
}
