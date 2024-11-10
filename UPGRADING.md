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

## Change `DatabaseSource` to `PdoSource`

**Before**

``` php
use Rougin\Transcribe\Source\DatabaseSource;

$source = new DatabaseSource($pdo);
```

**After**

``` php
use Rougin\Transcribe\Source\PdoSource;

$source = new PdoSource;
```

## Change `DirectorySource` to `FileSource`

**Before**

``` php
use Rougin\Transcribe\Source\DirectorySource;

$source = new DirectorySource($pdo);
```

**After**

``` php
use Rougin\Transcribe\Source\FileSource;

$source = new FileSource;
```

## Change `SourceCollection::addSource` to `SourceCollection::add`

**Before**

``` php
use Rougin\Transcribe\Source\SourceCollection;
use Rougin\Transcribe\Source\FileSource;

$source = new SourceCollection;

$source->addSource(new FileSource);
```

**After**

``` php
use Rougin\Transcribe\Source\SourceCollection;
use Rougin\Transcribe\Source\FileSource;

$source = new SourceCollection;

$source->add(new FileSource);
```

## Change `SourceInterface::getWords` to `SourceInterface::words`

**Before**

``` php
namespace Rougin\Transcribe\Source;

interface SourceInterface
{
    public function getWords();
}
```

**After**

``` php
namespace Rougin\Transcribe\Source;

interface SourceInterface
{
    public function words();
}
```

## Change `Transcribe::getVocabulary` to `Transcribe::all`

**Before**

``` php
use Rougin\Transcribe\Transcribe;

// ...

$transcribe = new Transcribe($source);

/** @var array<string, array<string, string>> */
$words = $transcribe->getVocabulary();
```

**After**

``` php
use Rougin\Transcribe\Transcribe;

// ...

$transcribe = new Transcribe($source);

/** @var array<string, array<string, string>> */
$words = $transcribe->words();
```

## Change `Transcribe::getText` to `Transcribe::get`

**Before**

``` php
use Rougin\Transcribe\Transcribe;

/** @var \Rougin\Transcribe\Source\SourceInterface */
$source = /** ... */;

$transcribe = new Transcribe($source);

/** @var string */
$text = $transcribe->getText('fil_PH.name');
```

**After**

``` php
use Rougin\Transcribe\Transcribe;

/** @var \Rougin\Transcribe\Source\SourceInterface */
$source = /** ... */;

$transcribe = new Transcribe($source);

$transcribe->get('fil_PH.name');
```