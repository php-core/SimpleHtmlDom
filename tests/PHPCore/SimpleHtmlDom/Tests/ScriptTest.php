<?php

namespace PHPCore\SimpleHtmlDom\Tests;

/**
 * Checks if the parser properly handles script elements
 */
class ScriptTest extends BaseTest
{
	/**
	 * @dataProvider dataProvider_for_script_should_parse
	 */
	public function test_script_should_parse($expected, $doc)
	{
		$this->html->load($doc);
		$this->assertEquals($expected, $this->html->find('script', 0)->innertext);
		$this->assertEquals($doc, $this->html->save());
	}

	public function dataProvider_for_script_should_parse()
	{
		return [
			'empty'             => [
				'',
				'<script></script>',
			],
			'empty with type'   => [
				'',
				'<script type="application/javascript"></script>',
			],
			'space'             => [
				' ',
				'<script> </script>',
			],
			'html string'       => [
				"var foo = '<div>Hello, World!</div>';",
				"<script>var foo = '<div>Hello, World!</div>';</script>",
			],
			'newline'           => [
				"\n",
				"<script>\n</script>",
			],
			'newline with type' => [
				"\n",
				"<script type=\"application/javascript\">\n</script>",
			],
		];
	}

	public function test_html_inside_script_should_not_appear_in_the_dom()
	{
		$this->html->load('<script><div>Hello, World!</div></script>');
		$this->assertNotNull($this->html->find('script', 0));
		$this->assertNull($this->html->find('div', 0));
	}
}
