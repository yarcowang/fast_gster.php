# Fast Getter and Setter

## Install 
```bash
composer require yarco/fast-gster
```

## Usage 
```php
<?php

use \Yarco\FastGster\{Base, Get, Set};

class Example03
{
    use Base;

    // comparing to define "getName, setName" by hand
    #[Get, Set]
    private string $name;

    // can also add a guard, will throw an exception if the guard is not met
    #[Get, Set('age > 0 and age < 120')]
    private int $age;
}
```

see more in `tests/`.

## Expression Language
[Read more expression language from Symfony](https://symfony.com/doc/current/reference/formats/expression_language.html)