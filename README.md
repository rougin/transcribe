# Transcribe

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]][link-license]
[![Build Status][ico-build]][link-build]
[![Coverage Status][ico-coverage]][link-coverage]
[![Total Downloads][ico-downloads]][link-downloads]

Transcribe is a simple localization package for PHP. A localization source can be file-based (similar to [Laravel's Localization](https://laravel.com/docs/5.7/localization)) or from a database connection.

## Installation

Install `Transcribe` through [Composer](https://getcomposer.org/):

``` bash
$ composer require rougin/transcribe
```

## Basic Usage

### Load a list of texts from a directory

The `Transcribe` package needs to have a localization file which contains the list of texts with its translations (e.g., `fil_PH.php`):

``` php
// locales/fil_PH.php

$texts = array();

$texts['language'] = 'linguahe';
$texts['name'] = 'pangalan';
$texts['school'] = 'paaralan';

return $texts;
```

Specify the path of the localization files in the `Transcribe` class:

``` php
// index.php

use Rougin\Transcribe\Source\DirectorySource;
use Rougin\Transcribe\Transcribe;

// Specify the localization source ---
$path = (string) __DIR__ . '/locales';

$source = new DirectorySource($path);
// -----------------------------------

$transcribe = new Transcribe($source);
```

### Load a list of texts from a database

Alternatively, the localization source can be from a database. It should have the following fields in a specified table:

* `name` - name of the database table
* `language` - language name based from a locale (e.g `en_GB`)
* `text` - a keyword or a text to be translated
* `translation` - translation from the based language

```
| language | text   | translation |
| -------- | ------ | ----------- |
| fil_PH   | name   | pangalan    |
| fil_PH   | school | paaralan    |
```

``` php
// index.php

use Rougin\Transcribe\Source\DirectorySource;
use Rougin\Transcribe\Transcribe;

// Create a PDO instance -----------------
$dsn = 'mysql:host=localhost;dbname=demo';

$pdo = new PDO($dsn, 'root', '');
// ---------------------------------------

// Specify the fields from the table ---
$table = array('name' => 'words');
$table['language'] = 'language';
$table['translation'] = 'translation';
$table['text'] = 'text';
// -------------------------------------

$source = new DatabaseSource($pdo, $table);

$transcribe = new Transcribe($source);
```

### Load list of texts from different sources

If having multiple localization sources, the `SourceCollection` class can be used to store them into a single class:

``` php
// index.php

use Rougin\Transcribe\Source\DatabaseSource;
use Rougin\Transcribe\Source\DirectorySource;
use Rougin\Transcribe\Source\SourceCollection;
use Rougin\Transcribe\Transcribe;

$collection = new SourceCollection;

// "$database" is a DatabaseSource
// "$directory" is a DirectorySource

$collection->add($database)->add($directory);

$transcribe = new Transcribe($collection);
```

### Getting a text from the vocabulary

Use the `get` method to get a specified translation. While use the `all` method to get all the available texts:

``` php
// Returns all stored texts
$texts = $transcribe->all();

// Returns translation of 'name' in 'fil_PH' group (e.g "pangalan")
$text = $transcribe->get('fil_PH.name');
```

### Adding new source

Adding custom sources is possible by implementing them to `SourceInterface`:

``` php
namespace Rougin\Transcribe\Source;

interface SourceInterface
{
    /**
     * Returns an array of words.
     *
     * @return array
     */
    public function words();
}
```

## Changelog

Please see [CHANGELOG][link-changelog] for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Credits

- [All contributors][link-contributors]

## License

The MIT License (MIT). Please see [LICENSE][link-license] for more information.

[ico-build]: https://img.shields.io/github/actions/workflow/status/rougin/wildfire/build.yml?style=flat-square
[ico-coverage]: https://img.shields.io/codecov/c/github/rougin/wildfire?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/rougin/wildfire.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-version]: https://img.shields.io/packagist/v/rougin/wildfire.svg?style=flat-square

[link-build]: https://github.com/rougin/wildfire/actions
[link-changelog]: https://github.com/rougin/wildfire/blob/master/CHANGELOG.md
[link-contributors]: https://github.com/rougin/wildfire/contributors
[link-coverage]: https://app.codecov.io/gh/rougin/wildfire
[link-downloads]: https://packagist.org/packages/rougin/wildfire
[link-license]: https://github.com/rougin/wildfire/blob/master/LICENSE.md
[link-packagist]: https://packagist.org/packages/rougin/wildfire
[link-upgrading]: https://github.com/rougin/wildfire/blob/master/UPGRADING.md