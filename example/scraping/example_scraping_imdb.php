<?php
/**
 * This example loads a page from IMDb and displays the most important details
 * in a custom format.
 */
require_once dirname(__DIR__, 2).'/vendor/autoload.php';

use PHPCore\SimpleHtmlDom\HtmlWeb;

// Load the page into memory
$doc = new HtmlWeb();
$html = $doc->load('https://imdb.com/title/tt0335266/');

// Extract details
$title = $html->find('title', 0)->plaintext;
$rating = $html->find('div[class="ratingValue"] span', 0)->plaintext;
$storyline = $html->find('#titleStoryLine p', 0)->plaintext;

// Clean up memory
$html->clear();
unset($html);

echo '<h1>' . $title . '</h1><p>Rating: ' . $rating . '<br>' . $storyline . '</p>';
