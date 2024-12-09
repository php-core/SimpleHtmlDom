<?php

namespace PHPCore\SimpleHtmlDom\Tests;

/**
 * Tests the cURL part of HtmlWeb
 */
class HtmlWebCurlTest extends WebTest
{
	/** @dataProvider urlProvider */
	public function test_load_should_return_dom_object($url)
	{
		$this->assertNotNull($this->web->load($url));
	}

	public function test_load_should_return_null_on_negative_response()
	{
		$this->assertNull($this->web->load('https://simplehtmldom.sourceforge.io/a.html'));
	}

	public function test_load_should_return_null_for_pages_larger_than_max_file_size()
	{
		$this->assertNull($this->web->load('https://www.w3.org/TR/html52/single-page.html'));
	}
}
