The following are the breaking changes introduced in `v0.4.0`. As previously mentioned, this was done to improve its extensibility, simplicity and maintainbility. Please see the `"Breaking bad" packages` in [my blog post](https://roug.in/hello-world-again/) for the said reason:

## Replace code marked as `@deprecated`

Prior in updating `Transcribe` to `v0.4.0`, kindly check to replace any code that were marked as `@deprecated`. The specified `@deprecated` code can also be highlighted if using an Integrated Development Environment (IDE):

``` php
namespace Rougin\Transcribe\Source;

/**
 * @deprecated since ~0.4, use "SourceCollection" instead.
 *
 * @package Transcribe
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class MultipleSource extends SourceCollection
```

> [!WARNING]
> This is required as the `v0.4.0` release will remove all `@deprecated` code.

## Change `MultipleSource` to `SourceCollection`

**Before**

``` php
use Rougin\Transcribe\Source\MultipleSource;

$source = new MultipleSource;
```

**After**

``` php
use Rougin\Transcribe\Source\SourceCollection;

$source = new SourceCollection;
```

## Change `Transcribe` to `Locale`

**Before**

``` php
use Rougin\Transcribe\Transcribe;

// ...

$locale = new Transcribe($source);
```

**After**

``` php
use Rougin\Transcribe\Locale;

// ...

$locale = new Locale($source);
```

## Change `DatabaseSource` to `PdoSource`

**Before**

``` php
use Rougin\Transcribe\Source\DatabaseSource;

// ...

$source = new DatabaseSource($pdo);
```

**After**

``` php
use Rougin\Transcribe\Source\PdoSource;

// ...

$source = new PdoSource($pdo);
```

## Change `DirectorySource` to `FileSource`

**Before**

``` php
use Rougin\Transcribe\Source\DirectorySource;

// ...

$source = new DirectorySource($path);
```

**After**

``` php
use Rougin\Transcribe\Source\FileSource;

// ...

$source = new FileSource($path);
```

## Change `SourceCollection::addSource` to `SourceCollection::add`

**Before**

``` php
use Rougin\Transcribe\Source\SourceCollection;
use Rougin\Transcribe\Source\FileSource;

$source = new SourceCollection;

// ...

$source->addSource(new FileSource($path));
```

**After**

``` php
use Rougin\Transcribe\Source\SourceCollection;
use Rougin\Transcribe\Source\FileSource;

$source = new SourceCollection;

// ...

$source->add(new FileSource($path));
```

## Change `SourceInterface::getWords` to `SourceInterface::words`

**Before**

``` php
namespace Rougin\Transcribe\Source;

interface SourceInterface
{
    /**
     * @return array<string, array<string, string>>
     */
    public function getWords();
}
```

**After**

``` php
namespace Rougin\Transcribe\Source;

interface SourceInterface
{
    /**
     * @return array<string, array<string, string>>
     */
    public function words();
}
```

## Change `Transcribe::getVocabulary` to `Locale::all`

**Before**

``` php
use Rougin\Transcribe\Transcribe;

// ...

$locale = new Transcribe($source);

/** @var array<string, array<string, string>> */
$words = $locale->getVocabulary();
```

**After**

``` php
use Rougin\Transcribe\Locale;

// ...

$locale = new Locale($source);

/** @var array<string, array<string, string>> */
$words = $locale->words();
```

## Change `Transcribe::getText` to `Locale::get`

**Before**

``` php
use Rougin\Transcribe\Transcribe;

// ...

$locale = new Transcribe($source);

/** @var string */
$text = $locale->getText('fil_PH.name');
```

**After**

``` php
use Rougin\Transcribe\Locale;

// ...

$locale = new Locale($source);

$locale->get('fil_PH.name');
```