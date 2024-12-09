<?php
declare(strict_types=1);

namespace PHPCore\SimpleHtmlDom\Tests;

use PHPCore\SimpleHtmlDom\HtmlDocument;
use PHPUnit\Framework\TestCase;

class BaseTest extends TestCase {

	protected HtmlDocument $html;

	protected function setUp(): void
	{
		$this->html = new HtmlDocument();
	}

	protected function tearDown(): void
	{
		$this->html->clear();
		unset($this->html);
	}
}
