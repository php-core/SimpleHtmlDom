<?php

namespace PHPCore\SimpleHtmlDom\Tests;

use PHPCore\SimpleHtmlDom\HtmlDocument;
use PHPUnit\Framework\TestCase;

/**
 * Tests for simple_html_dom entity decoding
 */
class entityDecodingTest extends TestCase
{
    /**
     * @dataProvider load_should_decode_entity_dataProvider
     */
    public function test_load_should_decode_entity($name, $char, $expected)
    {
        $this->assertEquals($expected, $char, 'Character: '.$name);
    }

    public function load_should_decode_entity_dataProvider(): array
    {
        $file = TEST_DATA_PATH.'/entity_decoding/Character Entity Reference Chart.html';

        // This operation is very slow due to missing closing tags
        $html = new HtmlDocument();
        $html->loadFile($file);

        $table = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES | ENT_HTML5, $html->target_charset);

        $vector = [];

        foreach ($html->find('table tr') as $tr) {
            $char = $tr->find('td.character', 0)->innertext;

            $name = $tr->find('td.named > code', 0)->plaintext;
            $name = explode(' ', $name)[0]; /* may contain multiple representations */

            $expected = array_search($name, $table, true);

            if ($expected === false) {
                continue;
            } /* Unknown entity */

            $vector[] = [
                $name,
                $char,
                $expected,
            ];
        }

        return $vector;
    }

    public function test_decode_should_decode_attributes()
    {
        $expected = 'Häagen-Dazs';

        $html = new HtmlDocument();
        $html->load('<meta name="description" content="H&auml;agen-Dazs">');

        $description = $html->find('meta[name="description"]', 0);

        $this->assertEquals($expected, $description->content);
    }

}
