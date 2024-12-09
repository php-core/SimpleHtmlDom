<?php

declare(strict_types=1);

namespace PHPCore\SimpleHtmlDom\Tests;

use PHPCore\SimpleHtmlDom\HtmlWeb;
use PHPUnit\Framework\TestCase;

class WebTest extends TestCase
{

	protected HtmlWeb $web;

	protected function setUp(): void
	{
		if (!extension_loaded('curl')) {
			$this->markTestSkipped('The cURL extension must be enabled for this test.');
		}

		$this->web = new HtmlWeb();
	}

	protected function tearDown(): void
	{
		unset($this->web);
	}

	public function urlProvider(): array
	{
		return [
			'Google' => ['https://www.google.com/'],
			'GitHub' => ['https://www.github.com/'],
		];
	}
}
