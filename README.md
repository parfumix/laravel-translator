##Introduction

Laravel translator allow you to easy translate your website using different drivers like **File**, **Database** and others. 

### Instalation
You can use the `composer` package manager to install. From console run:

```
  $ php composer.phar require parfumix/laravel-translator "v1.0"
```

or add to your composer.json file

    "parfumix/laravel-translator": "v1.0"

You have to publish package files using

```
  $ php artisan vendor:publish
```

### Configuration

To register package you have to follow standart procedure registering serviceProvider class .Open your configuration file located in **config/app.php** and search for array of providers:

```php
  'providers' => [
        // Add that line at the end of array ..
        'Translator\TranslatorServiceProvider'
      ]  
```

##Basic usage

Before using translator you have to publish your configuration file and select driver which you want to use

```
  $ php artisan vendor:publish
```

```yaml
# here will be set up default driver .
default_driver: file
```

After all that you just have to use :
```php
 __($key, $replacement, $locale = null) // will translate your key based on default selected driver. Locale will grab automaticly from localization component.
```

###Extending
You can register own translator drivers which have will have custom business logic . But for the first register it in your configuration file
```yaml
drivers:
  my_driver:
    class: Namespace\To\My\Driver
    option1: value1
    option2: value2
  database:
    class: Translator\Drivers\Database
    cache_time: 60
  file:
    class: Translator\Drivers\File
```

and create you class which implelement **Translatable** interface:

```php
<?php

namespace My\Namespace;

use Translator\Driver;
use Translator\Translatable;

class MyDriver extends Driver implements Translatable {

    // Get translation by key .
    public function get($key, $replacement = array(), $locale = null);

    // Check if has translation by key .
    public function has($key, $locale = null);
    
    // Delete translation by key .
    public function delete($key, $group, $locale = null);
    
    // Save your translation to source .
    public function translate($key, $translation, $locale = null);

}
```

