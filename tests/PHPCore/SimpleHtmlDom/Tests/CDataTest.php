<?php

namespace PHPCore\SimpleHtmlDom\Tests;

/**
 * Checks if the parser properly handles CDATA sections
 */
class CDataTest extends BaseTest
{
    /**
     * @dataProvider dataProvider_for_cdata_should_parse
     */
    public function test_cdata_should_parse($expected, $doc)
    {
        $this->html->load($doc);
        $this->assertEquals($expected, $this->html->find('cdata', 0)->innertext);
        $this->assertEquals($doc, $this->html->save());
    }

    public function dataProvider_for_cdata_should_parse(): array
    {
        return [
            'empty'    => [
                '',
                '<![CDATA[]]>',
            ],
            'space'    => [
                ' ',
                '<![CDATA[ ]]>',
            ],
            'brackets' => [
                ']][[',
                '<![CDATA[]][[]]>',
            ],
            'html'     => [
                '<p>Hello, World!</p>',
                '<![CDATA[<p>Hello, World!</p>]]>',
            ],
            'comment'  => [
                '<!-- Hello, World! -->',
                '<![CDATA[<!-- Hello, World! -->]]>',
            ],
            'newline'  => [
                "Hello\nWorld!",
                "<![CDATA[Hello\nWorld!]]>",
            ],
        ];
    }

    public function test_html_inside_cdata_should_not_appear_in_the_dom()
    {
        $this->html->load('<![CDATA[<div>Hello, World!</div>]]>');
        $this->assertNotNull($this->html->find('cdata', 0));
        $this->assertNull($this->html->find('div', 0));
    }
}
