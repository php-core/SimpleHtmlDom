<?php
// This example illustrates how to extract text content from a webpage
require_once dirname(__DIR__).'/vendor/autoload.php';

use PHPCore\SimpleHtmlDom\HtmlWeb;

$doc = new HtmlWeb();
echo $doc->load('https://www.google.com/')->plaintext;
