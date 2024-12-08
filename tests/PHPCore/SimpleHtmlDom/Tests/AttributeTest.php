<?php

namespace PHPCore\SimpleHtmlDom\Tests;

/**
 * Tests the attribute parsing behavior of the parser
 */
class AttributeTest extends BaseTest
{

    /** @dataProvider dataProvider_for_attribute_should_parse */
    public function test_attribute_should_parse($expected, $doc)
    {
        $this->html->load($doc);
        $this->assertEquals($expected, $this->html->save());
    }

    public function dataProvider_for_attribute_should_parse(): array
    {
        return [
            'double quotes' => [
                '<p class="hidden"></p>',
                '<p class="hidden"></p>',
            ],
            'single quotes' => [
                '<p class=\'hidden\'></p>',
                '<p class=\'hidden\'></p>',
            ],
            'no quotes'     => [
                '<p class=hidden></p>',
                '<p class=hidden></p>',
            ],
            'no value'      => [
                '<p hidden></p>',
                '<p hidden></p>',
            ],
        ];
    }
}
