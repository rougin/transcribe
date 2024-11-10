# Transcribe

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]][link-license]
[![Build Status][ico-build]][link-build]
[![Coverage Status][ico-coverage]][link-coverage]
[![Total Downloads][ico-downloads]][link-downloads]

`Transcribe` is a simple localization package written in PHP in which the translated word can be retrieved easily based on the specified locale. A localization source can be from multiple `.php` files or from a database connection using [PDO](https://www.php.net/manual/en/intro.pdo.php).

## Installation

Install the `Transcribe` package via [Composer](https://getcomposer.org/):

``` bash
$ composer require rougin/transcribe
```

## Basic usage

Prior in using `Transcribe`, a list of words must be provided with its specified translations (e.g., `fil_PH.php`):

``` php
// locales/fil_PH.php

$texts = array();

$texts['language'] = 'linguahe';
$texts['name'] = 'pangalan';
$texts['school'] = 'paaralan';

return $texts;
```

Once provided, specify the words in a source (e.g., `FileSource`):

``` php
// index.php

use Rougin\Transcribe\Source\FileSource;

// ...

$source = new FileSource;

// Add the directory to the source ----
$source->addPath(__DIR__ . '/locales');
// ------------------------------------
```

After creating the specified source, use the `get` method from the `Transcribe` class to get the localized word based on its keyword:

``` php
// index.php

use Rougin\Transcribe\Transcribe;

// ...

/** @var \Rougin\Transcribe\Source\FileSource */
$source = /** ... */;

$transcribe = new Transcribe($source);

echo $transcribe->get('fil_PH.name');
```

``` bash
$ php index.php
pangalan
```

Using the `setLocale` method can define the default locale. Having a default locale, there is no need to specify it when using the `get` method:

``` php
// index.php

$transcribe->setLocale('fil_PH');

// No need to specify "fil_PH" ---
echo $transcribe->get('name');
// -------------------------------
```

## Using sources

The previous example uses the `FileSource` that uses `.php` files to load the localized words. But `Transcribe` also provides a way in getting the said localized words through a database using the `PdoSource`:

``` php
// index.php

use Rougin\Transcribe\Source\PdoSource;

// ...

// Create a PDO instance -----------------
$dsn = 'mysql:host=localhost;dbname=demo';

$pdo = new PDO($dsn, 'root', /** ... */);
// ---------------------------------------

$source = new PdoSource($pdo);

// ...
```

When using the `PdoSource` class, it can also specify the database table and its columns to be used for getting the localized words:

```
# Contents of the "locales" table

| `id` | `type` | `name` | `text`   |
|------|--------|--------|----------|
| 1    | fil_PH | name   | pangalan |
| 2    | fil_PH | school | paaralan |
```

``` php
// ...

// Use "locales" table from database ---
$source->setTableName('locales');
// -------------------------------------

// Use "type" column from "locales" table ---
$source->setTypeColumn('type');
// ------------------------------------------

// Use "name" column from "locales" table ---
$source->setNameColumn('name');
// ------------------------------------------

// Use "text" column from "locales" table ---
$source->setTextColumn('text');
// ------------------------------------------

// ...
```

> [!NOTE]
> If the required table and columns were not specified, its default values are the same from the above-example (e.g., `locales` for table, and `locale`, `name`, and `text` values for the columns).

Then use the same `get` method from `Transcribe` class to get the localized word from the database table:

``` php
// index.php

// ...

echo $transcribe->get('fil_PH.name');
```

``` bash
$ php index.php
pangalan
```

## Creating custom sources

To create a custom source, kindly use the `SourceInterface` for its implementation:

``` php
namespace Rougin\Transcribe\Source;

interface SourceInterface
{
    /**
     * Returns an array of words.
     *
     * @return array<string, array<string, string>>
     */
    public function words();
}
```

The `words` method should return a list of words in an associative array format:

``` php
return array(
    'fil_PH' => array(
        'language' => 'linguahe',
        'name' => 'pangalan',
        'school' => 'paaralan',
    ),
);
```

The specified method will be used a the reference for getting the localized word from the `get` method of `Transcribe` class.

## Migrating to the `v0.4.0` release

The new release for `v0.4.0` will be having a [backward compatibility](https://en.wikipedia.org/wiki/Backward_compatibility) break (BC break). With this, some functionalities from the earlier versions might not be working after upgrading. This was done to increase extensibility, simplicity and maintainbility. One of the packages that requires for BC break was `Transcribe` based on [my blog post](https://roug.in/hello-world-again/):

> I also want to extend this plan to my personal packages as well like [Staticka](https://github.com/staticka/staticka) and [Transcribe](https://github.com/rougin/transcribe). With this, I will introduce backward compatibility breaks to them initially as it is hard to migrate their codebase due to minimal to no documentation being provided in its basic usage and its internals. As I checked their code, I realized that they are also over engineered, which is a mistake that I needed to atone for when updating my packages in the future.

Please see [Pull Request #1](https://github.com/rougin/transcribe/pull/1) for the files that were removed or updated in this release and the [UPGRADING][link-upgrading] page for the specified breaking changes.

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

[ico-build]: https://img.shields.io/github/actions/workflow/status/rougin/transcribe/build.yml?style=flat-square
[ico-coverage]: https://img.shields.io/codecov/c/github/rougin/transcribe?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/rougin/transcribe.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-version]: https://img.shields.io/packagist/v/rougin/transcribe.svg?style=flat-square

[link-build]: https://github.com/rougin/transcribe/actions
[link-changelog]: https://github.com/rougin/transcribe/blob/master/CHANGELOG.md
[link-contributors]: https://github.com/rougin/transcribe/contributors
[link-coverage]: https://app.codecov.io/gh/rougin/transcribe
[link-downloads]: https://packagist.org/packages/rougin/transcribe
[link-license]: https://github.com/rougin/transcribe/blob/master/LICENSE.md
[link-packagist]: https://packagist.org/packages/rougin/transcribe
[link-upgrading]: https://github.com/rougin/transcribe/blob/master/UPGRADING.md