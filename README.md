File Iterator implementing Seekable Iterator
===================
## Usage ##
```php

$fileIterator = new \App\FileIterator('/path/to/file');

foreach ($fileIterator as $key => $current) {
    //your logic here
}

```

## Tests ##

```
composer test

```
