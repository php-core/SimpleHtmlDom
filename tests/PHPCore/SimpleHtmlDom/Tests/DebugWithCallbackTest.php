<?php

namespace PHPCore\SimpleHtmlDom\Tests;

use PHPCore\SimpleHtmlDom\Debug;
use PHPUnit\Framework\TestCase;

/**
 * Tests the Debug class with custom callback
 */
class DebugWithCallbackTest extends TestCase
{
	private ?string $debug_message;

	protected function setUp(): void
	{
		Debug::setDebugHandler([$this, 'debugMessageHandler']);
		Debug::enable();

		// Discard initial message
		$this->debug_message = null;
	}

	protected function tearDown(): void
	{
		Debug::disable();
		Debug::setDebugHandler();
	}

	public function debugMessageHandler($message): void
	{
		$this->debug_message = $message;
	}

	public function test_enable_should_issue_a_message()
	{
		$this->assertNull($this->debug_message);
		Debug::enable();
		$this->assertNotNull($this->debug_message);
	}

	public function test_disable_should_issue_a_message()
	{
		$this->assertNull($this->debug_message);
		Debug::disable();
		$this->assertNotNull($this->debug_message);
	}

	public function test_log_should_issue_the_message()
	{
		$expected = 'Hello, World!';
		$this->assertNull($this->debug_message);
		Debug::log('Hello, World!');
		$this->assertStringContainsString($expected, $this->debug_message);
	}

	public function test_log_should_issue_the_same_message_multiple_times()
	{
		$expected = 'Hello, World!';
		$this->assertNull($this->debug_message);

		for ($i = 0; $i < 2; $i++) {
			Debug::log('Hello, World!');
			$this->assertStringContainsString($expected, $this->debug_message);
			$this->debug_message = null;
		}
	}

	public function test_log_once_should_issue_the_message_only_once()
	{
		$this->assertNull($this->debug_message);

		for ($i = 0; $i < 2; $i++) {
			Debug::log_once('Hello, World!');
			if ($i === 0) {
				$this->assertStringContainsString('Hello, World!', $this->debug_message);
			} else {
				$this->assertNull($this->debug_message);
			}
			$this->debug_message = null;
		}
	}
}
