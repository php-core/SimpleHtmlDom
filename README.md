# PHP Simple HTML DOM Parser

[![LICENSE](https://img.shields.io/github/license/php-core/simplehtmldom?logo=github&style=for-the-badge)](https://github.com/php-core/simplehtmldom/blob/master/LICENSE)
[![BASIC TESTS](https://img.shields.io/github/workflow/status/php-core/simplehtmldom/Basic%20Tests?label=Basic%20Tests&logo=github&style=for-the-badge)](https://github.com/php-core/simplehtmldom/actions/workflows/basic_tests.yml)
[![PACKAGIST](https://img.shields.io/packagist/v/php-core/simplehtmldom?logo=composer&style=for-the-badge)](https://packagist.org/packages/php-core/simplehtmldom)

simplehtmldom is a fast and reliable HTML DOM parser for PHP.

This is a fork of the [Simple HTML DOM Parser project](https://sourceforge.net/p/simplehtmldom) which aims to make "composer" compatibility better and clean-up some code, introduce type-safety and generally keep the project up-to-date.

## Key features

* Purely PHP-based DOM parser (no XML extensions required).
* Works with well-formed and broken HTML documents.
* Loads webpages, local files and document strings.
* Supports CSS selectors.

## Requirements

simplehtmldom requires **PHP 8.1 or higher** with [ext-iconv](https://www.php.net/manual/en/book.iconv.php) enabled. Following extensions enable additional features of the parser:

* [ext-mbstring](https://secure.php.net/manual/en/book.mbstring.php) (recommended) \
Enables better detection for multi-byte documents.
* [ext-curl](https://secure.php.net/manual/en/book.curl.php) \
Enables cURL support for the class `HtmlWeb`.
* [ext-openssl](https://secure.php.net/manual/en/book.openssl.php) (recommended when using cURL) \
Enables SSL support for cURL.

## Installation

```sh
composer require php-core/simplehtmldom
```

## Usage

```php
<?php
include_once 'vendor/autoload.php';
use PHPCore\SimpleHtmlDom\HtmlWeb;

$client = new HtmlWeb();
$html = $client->load('https://www.google.com/search?q=simplehtmldom');

// Returns the page title
echo $html->find('title', 0)->plaintext . PHP_EOL;
```

Find more examples in the installation folder under `examples`.

## Documentation

The documentation for this library is hosted at [https://php-core.com/simplehtmldom/](https://php-core.com/simplehtmldom/)

If you want to contribute code to the project, simply do a pull-request towards the [project repository](https://github.com/php-core/simplehtmldom).

## Authors

 * [S.C. Chen](https://sourceforge.net/u/me578022/)
 * [John Schlick](https://sourceforge.net/u/john_schlick/)
 * [logmanoriginal](https://sourceforge.net/u/logmanoriginal/)
 * Rus Carroll
 * Yousuke Kumakura
 * Vadim Voituk
 * [PHPCore](https://php-core.com)

## License

The source code for simplehtmldom is licensed under the MIT license. For further information read the LICENSE file in the root directory (should be located next to this README file).

## Technical notes

simplehtmldom is a purely PHP-based DOM parser that doesn't rely on external libraries like [libxml](https://www.php.net/manual/en/book.libxml.php), [SimpleXML](https://www.php.net/manual/en/book.simplexml.php) or [PHP DOM](https://www.php.net/manual/en/book.dom.php). Doing so provides better control over the parsing algorithm and a much simpler API that even novice users can learn to use in a short amount of time.
