<?php

namespace PHPCore\SimpleHtmlDom\Tests;

use PHPCore\SimpleHtmlDom\HtmlNode;

// @note disabled for now as it doesn't seem to work properly across different platforms

/**
 * Test if the parser properly detects document encodings
 */
class charset_test extends BaseTest
{
    /**
     * @dataProvider fileProvider
     */
    public function test_charset($path)
    {
        $expected = strtoupper(basename($path, '.html'));

        $this->html->loadFile($path);

        $this->assertEquals($expected, $this->html->_charset);
    }

    /** @dataProvider fileProvider */
    public function test_is_utf8($file)
    {
        $testdata = file_get_contents($file);

        if (strtoupper(basename($file, '.html')) === 'UTF-8') {
            $this->assertTrue(HtmlNode::is_utf8($testdata));
        } else {
            $this->assertFalse(HtmlNode::is_utf8($testdata));
        }
    }

    /** @dataProvider fileProvider */
    public function test_convert_text_should_handle_different_encodings($file)
    {
        $testdata = file_get_contents($file);
        $charset = strtoupper(basename($file, '.html'));
        $expected = iconv($charset, 'UTF-8', $testdata);

        $this->html->load(''); // We need at least the root node

        if ($charset === 'UTF-8') {
            $this->html->_charset = 'TryMe'; // Trap the parser
            // Add UTF-8 BOM
            $testdata = "\xef\xbb\xbf".$testdata;
        } else {
            $this->html->_charset = $charset; // Hint source charset
        }

        $this->html->_target_charset = 'UTF-8'; // Enforce target charset

        $this->assertEquals($expected, $this->html->root->convert_text($testdata));
    }

    public function fileProvider(): array
    {
        $files = [];

        foreach (glob(TEST_DATA_PATH.'/charset/*.html') as $path) {
            $files[strtoupper(basename($path, '.html'))] = [$path];
        }

        return $files;
    }

}
