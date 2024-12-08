<?php

namespace PHPCore\SimpleHtmlDom\Tests;

/**
 * Checks if the parser properly handles comments
 */
class commentTest extends BaseTest
{
    /**
     * @dataProvider dataProvider_for_comment_should_parse
     */
    public function test_comment_should_parse($expected, $doc)
    {
        $this->html->load($doc);
        $this->assertEquals($expected, $this->html->find('comment', 0)->innertext);
        $this->assertEquals($doc, $this->html->save());
    }

    public function dataProvider_for_comment_should_parse(): array
    {
        return [
            'empty'                     => [
                '',
                '<!---->',
            ],
            'space'                     => [
                ' ',
                '<!-- -->',
            ],
            'brackets'                  => [
                ']][[',
                '<!--]][[-->',
            ],
            'html'                      => [
                '<p>Hello, World!</p>',
                '<!--<p>Hello, World!</p>-->',
            ],
            'cdata'                     => [
                '<![CDATA[Hello, World!]]>',
                '<!--<![CDATA[Hello, World!]]>-->',
            ],
            'newline'                   => [
                "Hello\nWorld!",
                "<!--Hello\nWorld!-->",
            ],
            'nested comment start tag'  => [
                '<!--',
                '<!--<!---->',
            ],
            'reverse comment start tag' => [
                '--!>',
                '<!----!>-->',
            ],
            'almost comment start tag'  => [
                '<!-',
                '<!--<!--->',
            ],
        ];
    }

    public function test_html_inside_comment_should_not_appear_in_the_dom()
    {
        $this->html->load('<!-- <div>Hello, World!</div> -->');
        $this->assertNotNull($this->html->find('comment', 0));
        $this->assertNull($this->html->find('div', 0));
    }

    public function test_comment_starting_with_greater_than_sign_should_break_comment()
    {
        $this->html->load('<!--><div>Hello, World!</div>-->');
        $this->assertEquals('Hello, World!', $this->html->find('div', 0)->plaintext);
    }

    public function test_comment_starting_with_dash_plus_greater_than_sign_should_break_comment()
    {
        $this->html->load('<!---><div>Hello, World!</div>-->');
        $this->assertEquals('Hello, World!', $this->html->find('div', 0)->plaintext);
    }
}
