<?php

namespace PHPCore\SimpleHtmlDom\Tests;

use PHPUnit\Framework\TestCase;

/**
 * Tests strGetHtmlDom
 */
class strGetHtmlDomTest extends TestCase
{
	/**
	 * strGetHtmlDom should return false on empty string.
	 */
	public function test_empty_string_should_return_false()
	{
		$this->assertFalse(strGetHtmlDom(''));
	}
}
