# Transcribe

[![Latest Stable Version](https://poser.pugx.org/rougin/transcribe/v/stable)](https://packagist.org/packages/rougin/transcribe) [![Total Downloads](https://poser.pugx.org/rougin/transcribe/downloads)](https://packagist.org/packages/rougin/transcribe) [![Latest Unstable Version](https://poser.pugx.org/rougin/transcribe/v/unstable)](https://packagist.org/packages/rougin/transcribe) [![License](https://poser.pugx.org/rougin/transcribe/license)](https://packagist.org/packages/rougin/transcribe)

Yet another language library for PHP

# Installation

Install ```Transcribe``` via [Composer](https://getcomposer.org):

```$ composer require rougin/transcribe```

# Usage

### Load a list of texts from a directory

**locales/fil_PH.php**

```php
return array(
	'name' => 'pangalan',
	'language' => 'linguahe',
	'school' => 'paaralan'
);
```

**index.php**

```php
require 'vendor/autoload.php';

use Rougin\Transcribe\Transcribe;

$transcribe = new Transcribe('locales');

print_r($transcribe->getVocabulary());
```

**Result**

```bash
Array
(
    [fil_PH] => Array
        (
            [name] => pangalan
            [language] => linguahe
            [school] => paaralan
        )

)
```

### Load a list of texts from a database

The contents of the **word** table

| language      | text          | translation  |
| ------------- | ------------- | ------------ |
| fil_PH        | name          | pangalan     |
| fil_PH        | school        | paaralan     |

**index.php**

```php
require 'vendor/autoload.php';

use Rougin\Transcribe\Transcribe;

/**
 * Database credentials
 */

$credentials = array(
	'driver' => 'mysql',
	'hostname' => 'localhost',
	'database' => 'demo',
	'charset' => 'utf8',
	'username' => 'root',
	'password' => '',
);

/**
 * Name of the table and its corresponding columns
 * If not specified, the default columns are:
 *     language -> Language name based from a locale (e.g en_GB, en_US)
 *          or just group of words
 *     text -> A keyword or a text to be translated
 *     translation -> The translation from the based language
 */

$table = array(
	'name' => 'word',
	'language' => 'language',
	'text' => 'text',
	'translation' => 'translation'
);

$transcribe = new Transcribe($credentials, $table);

print_r($transcribe->getVocabulary());
```

**Result**

```bash
Array
(
    [fil_PH] => Array
        (
            [name] => pangalan
            [school] => paaralan
        )
)
```

### Load list of texts from different sources

**index.php**

```php
$transcribe = new Transcribe($credentials, $table);
$transcribe->getDirectory('locale')
	->getDirectory('another/directory')
	->getDatabase($anotherCredentials, $table);
```

### Getting a text from the *vocabulary*

**index.php**

```php
$transcribe->getVocabulary(); // Returns all stored texts
$translation->getText('fil_PH.name'); // Returns translation of 'name' in 'fil_PH' group
```