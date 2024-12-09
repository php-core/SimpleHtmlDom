<?php
// This example illustrates how to modify HTML contents

require_once dirname(__DIR__) . '/vendor/autoload.php';

use PHPCore\SimpleHtmlDom\HtmlWeb;

// Load the document
$doc = new HtmlWeb();
$html = $doc->load('https://www.google.com/');

// Remove all images and inputs from the DOM
foreach($html->find('img, input') as $element) {
	$element->remove();
}

echo $html;
