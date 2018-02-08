## Magic Class

[![Build Status](https://travis-ci.org/phppackage/magic-class.svg?branch=master)](https://travis-ci.org/phppackage/magic-class)
[![StyleCI](https://styleci.io/repos/120748267/shield?branch=master)](https://styleci.io/repos/120748267)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/phppackage/magic-class/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/phppackage/magic-class/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/phppackage/magic-class/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/phppackage/magic-class/code-structure/master/code-coverage)
[![Packagist Version](https://img.shields.io/packagist/v/phppackage/magic-class.svg?style=flat-square)](https://github.com/phppackage/magic-class/releases)
[![Packagist Downloads](https://img.shields.io/packagist/dt/phppackage/magic-class.svg?style=flat-square)](https://packagist.org/packages/phppackage/magic-class)

A magical PHP class, which can be treated as an array or an object, which toString's to json.


## Install

Require this package with composer using the following command:

``` bash
$ composer require phppackage/magic-class
```

### Usage example:

    <?php
    require 'vendor/autoload.php';
    //
    use PHPPackage\MagicClass;
    
    // pre-initialize with constructor arguments
    $magicClass = new MagicClass('some value');
    
    // access as array or object
    echo $magicClass[0]   // some value
    echo $magicClass->{0} // some value
    
    // an empty instance
    $magicClass = new MagicClass();
    
    // add values
    $magicClass['foo'] = 'BarBaz';
    
    // access as array or object
    echo $magicClass['foo']; // BarBaz
    echo $magicClass->foo;   // BarBaz

    // variables can be invoked
    $magicClass->object = new class {
        private $foo = 'BarBaz';

        public function getFoo()
        {
            return $this->foo;
        }
    };
    echo $magicClass('object')->getFoo(); // BarBaz
    
    // toString dumps to json
    $magicClass['foo'] = 'BarBaz';
    
    echo strval($magicClass); // {"foo": "BarBaz"}
    
    // count elements
    echo count($magicClass) // 1
    
    // var_dump/print_r clean output
    print_r($magicClass);
    
    PHPPackage\MagicClass Object
    (
        [string] => BarBaz
    )


## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.


## Credits

 - [Lawrence Cherone](http://github.com/phppackage)
 - [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
