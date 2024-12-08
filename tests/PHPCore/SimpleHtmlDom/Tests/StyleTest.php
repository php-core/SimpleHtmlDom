<?php

namespace PHPCore\SimpleHtmlDom\Tests;

/**
 * Checks if the parser properly handles style elements
 */
class styleTest extends BaseTest
{
    /**
     * @dataProvider dataProvider_for_style_should_parse
     */
    public function test_style_should_parse($expected, $doc)
    {
        $this->html->load($doc);
        $this->assertEquals($expected, $this->html->find('style', 0)->innertext);
        $this->assertEquals($doc, $this->html->save());
    }

    public function dataProvider_for_style_should_parse()
    {
        return [
            'empty'                 => [
                '',
                '<style></style>',
            ],
            'empty without end tag' => [
                '',
                '<style/>',
            ],
            'space'                 => [
                ' ',
                '<style> </style>',
            ],
            'newline'               => [
                "\n",
                "<style>\n</style>",
            ],
            'multiple style tags'   => [
                'Hello',
                '<style>Hello</style><style>World</style>',
            ],
        ];
    }
}
