## From string

```php
<?php
require_once __DIR__. '/vendor/autoload.php';
use PHPCore\SimpleHtmlDom\HtmlDocument;

$html = new HtmlDocument();
$html->load('<html><body>Hello!</body></html>');
```

## From URL

```php
<?php
require_once __DIR__. '/vendor/autoload.php';
use PHPCore\SimpleHtmlDom\HtmlWeb;

$html = new HtmlWeb();
$html->load('http://www.google.com/');

```

## From file

```php
<?php
require_once __DIR__. '/vendor/autoload.php';
use PHPCore\SimpleHtmlDom\HtmlDocument;

$html = new HtmlDocument();
$html->loadFile('test.htm');
```
