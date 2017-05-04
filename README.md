# Transcribe

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

Yet another language library for PHP.

## Install

Via Composer

``` bash
$ composer require rougin/transcribe
```

## Usage

#### Load a list of texts from a directory

**locales/fil_PH.php**

``` php
return array(
    'name'     => 'pangalan',
    'language' => 'linguahe',
    'school'   => 'paaralan'
);
```

``` php
$directory  = new Rougin\Transcribe\Source\DirectorySource(__DIR__ . '/locales');
$transcribe = new Rougin\Transcribe\Transcribe($directory);
```

#### Load a list of texts from a database

The contents of the **word** table

| language      | text          | translation  |
| ------------- | ------------- | ------------ |
| fil_PH        | name          | pangalan     |
| fil_PH        | school        | paaralan     |

``` php
$pdo = new PDO('mysql:host=localhost;dbname=demo', 'root', '');

// Column names of the table you want to access
$table = [
    // Name of the table
    'name' => 'word',

    // Language name based from a locale (e.g en_GB) or just group of words
    'language' => 'language',

    // A keyword or a text to be translated
    'text' => 'text',

    // The translation from the based language
    'translation' => 'translation'
];

$database   = new Rougin\Transcribe\Source\DatabaseSource($pdo, $table);
$transcribe = new Rougin\Transcribe\Transcribe($database);
```

#### Load list of texts from different sources

``` php
$sources = new Rougin\Transcribe\Source\SourceCollection;

// Let's use $database and $directory from above as the example
$sources->addSource($database)->addSource($directory);

$transcribe = new Rougin\Transcribe\Transcribe($sources);
```

#### Getting a text from the *vocabulary*

``` php
// Returns all stored texts
$transcribe->getVocabulary();

// Returns translation of 'name' in 'fil_PH' group (e.g "pangalan")
$translation->getText('fil_PH.name');
```

#### Adding new source

You can always add a new source if you want. Just implement the source of your choice in a [SourceInterface](https://github.com/rougin/transcribe/blob/master/src/Source/SourceInterface.php).

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email rougingutib@gmail.com instead of using the issue tracker.

## Credits

- [Rougin Royce Gutib][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/rougin/transcribe.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/rougin/transcribe/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/rougin/transcribe.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/rougin/transcribe.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/rougin/transcribe.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/rougin/transcribe
[link-travis]: https://travis-ci.org/rougin/transcribe
[link-scrutinizer]: https://scrutinizer-ci.com/g/rougin/transcribe/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/rougin/transcribe
[link-downloads]: https://packagist.org/packages/rougin/transcribe
[link-author]: https://github.com/rougin
[link-contributors]: ../../contributors
