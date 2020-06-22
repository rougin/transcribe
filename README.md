# Transcribe

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]][link-license]
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

Transcribe is an easy-to-use localization library for PHP. The localization source can be file-based (similar to [Laravel's Localization](https://laravel.com/docs/5.7/localization)) or from a database connection.

## Installation

Install `Transcribe` through [Composer](https://getcomposer.org/):

``` bash
$ composer require rougin/transcribe
```

## Basic Usage

### Load a list of texts from a directory

**locales/fil_PH.php**

``` php
$texts = array();

$texts['language'] = 'linguahe';
$texts['name'] = 'pangalan';
$texts['school'] = 'paaralan';

return $texts;
```

``` php
use Rougin\Transcribe\Source\DirectorySource;
use Rougin\Transcribe\Transcribe;

$source = new DirectorySource(__DIR__ . '/locales');

$transcribe = new Transcribe($source);
```

### Load a list of texts from a database

The contents of the **words** table:

| language      | text          | translation  |
| ------------- | ------------- | ------------ |
| fil_PH        | name          | pangalan     |
| fil_PH        | school        | paaralan     |

``` php
use Rougin\Transcribe\Source\DirectorySource;
use Rougin\Transcribe\Transcribe;

$pdo = new PDO('mysql:host=localhost;dbname=demo', 'root', '');

$table = array('name' => 'words');

$table['language'] = 'language';
$table['text'] = 'text';
$table['translation'] = 'translation';

$source = new DatabaseSource($pdo, $table);

$transcribe = new Transcribe($source);
```

#### Must-have properties of `$table`

* `name` - name of the database table
* `language` - language name based from a locale (e.g `en_GB`)
* `text` - a keyword or a text to be translated
* `translation` - translation from the based language

### Load list of texts from different sources

``` php
use Rougin\Transcribe\Source\DatabaseSource;
use Rougin\Transcribe\Source\DirectorySource;
use Rougin\Transcribe\Source\SourceCollection;
use Rougin\Transcribe\Transcribe;

$collection = new SourceCollection;

// "$database" is a DatabaseSource instance
// while "$directory" is a DirectorySource.
$collection->add($database)->add($directory);

$transcribe = new Transcribe($collection);
```

### Getting a text from the *vocabulary*

``` php
// Returns all stored texts
$texts = $transcribe->all();

// Returns translation of 'name' in 'fil_PH' group (e.g "pangalan")
$text = $transcribe->get('fil_PH.name');
```

### Adding new source

Just implement it to a [SourceInterface](https://github.com/rougin/transcribe/blob/master/src/Source/SourceInterface.php).

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

[ico-code-quality]: https://img.shields.io/scrutinizer/g/rougin/transcribe.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/rougin/transcribe.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/rougin/transcribe.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/rougin/transcribe/master.svg?style=flat-square
[ico-version]: https://img.shields.io/packagist/v/rougin/transcribe.svg?style=flat-square

[link-changelog]: https://github.com/rougin/transcribe/blob/master/CHANGELOG.md
[link-code-quality]: https://scrutinizer-ci.com/g/rougin/transcribe
[link-contributors]: https://github.com/rougin/transcribe/contributors
[link-downloads]: https://packagist.org/packages/rougin/transcribe
[link-license]: https://github.com/rougin/transcribe/blob/master/LICENSE.md
[link-packagist]: https://packagist.org/packages/rougin/transcribe
[link-scrutinizer]: https://scrutinizer-ci.com/g/rougin/transcribe/code-structure
[link-travis]: https://travis-ci.org/rougin/transcribe