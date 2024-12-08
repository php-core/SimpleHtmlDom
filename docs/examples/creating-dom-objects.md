## From string

```php
<?php
include_once 'HtmlDocument';
use PHPCore\SimpleHtmlDom\HtmlDocument;

$html = new HtmlDocument();
$html->load('<html><body>Hello!</body></html>');
```

## From URL

```php
<?php
include_once 'HtmlWeb';
use PHPCore\SimpleHtmlDom\HtmlWeb;

$html = new HtmlWeb();
$html->load('http://www.google.com/');

```

## From file

```php
<?php
include_once 'HtmlDocument';
use PHPCore\SimpleHtmlDom\HtmlDocument;

$html = new HtmlDocument();
$html->loadFile('test.htm');
```
