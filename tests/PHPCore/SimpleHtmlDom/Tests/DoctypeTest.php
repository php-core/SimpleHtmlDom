<?php

namespace PHPCore\SimpleHtmlDom\Tests;

/**
 * Checks if the parser properly handles DOCTYPE
 */
class DoctypeTest extends BaseTest
{
	/**
	 * @dataProvider dataProvider_for_doctype_should_parse
	 */
	public function test_doctype_should_parse($expected, $doc)
	{
		// Note: The parser currently doesn't make any assumptions about DOCTYPE
		$this->html->load($doc);
		$this->assertEquals($expected, $this->html->root->plaintext);
		$this->assertEquals($doc, $this->html->save());
	}

	public function dataProvider_for_doctype_should_parse(): array
	{
		return [
			'normal'        => [
				'',
				'<!DOCTYPE html><html></html>',
			],
			'stray doctype' => [
				'Hello, World!',
				'<p><!DOCTYPE html>Hello, World!</p>',
			],
		];
	}
}
