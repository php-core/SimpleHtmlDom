<?php

namespace PHPCore\SimpleHtmlDom\Tests;

use PHPCore\SimpleHtmlDom\HtmlWeb;

/**
 * Tests the general behavior of HtmlWeb
 */
class htmlWebTest extends WebTest
{
    protected function setUp(): void
    {
        $this->web = new HtmlWeb();
    }

    public function urlProvider(): array
    {
        return [
            'Empty URL'      => [''],
            'Scheme Missing' => ['//github.com/simplehtmldom/'],
            'Wrong Scheme'   => ['ssh://github.com/'],
        ];
    }

    /** @dataProvider urlProvider */
    public function test_load_should_return_null_for_invalid_url($url)
    {
        $this->assertNull($this->web->load($url));
    }

    public function test_load_should_return_null_without_curl_and_fopen()
    {
        if (extension_loaded('curl')) {
            $this->markTestSkipped('The cURL extension must be disabled for this test.');
        }

        if (ini_get('allow_url_fopen')) {
            $this->markTestSkipped('allow_url_fopen must be disabled for this test.');
        }

        $this->assertNull($this->web->load('https://www.google.com/'));
    }
}
