<?php

namespace PHPCore\SimpleHtmlDom\Tests;

/**
 * Tests the DOM manipulation ability of the parser
 */
class domManipulationTest extends BaseTest
{
    public function test_dom_should_accept_nested_elements()
    {
        $expected = '<html><head></head><body></body></html>';

        $html = $this->html->createElement('html');
        $head = $this->html->createElement('head');
        $body = $this->html->createElement('body');

        $this->html->root->appendChild($html);

        $html
            ->appendChild($head)
            ->appendChild($body);

        $this->assertEquals($expected, $this->html->save());
    }

    public function test_dom_should_find_added_elements()
    {
        $html = $this->html->createElement('html');
        $head = $this->html->createElement('head');
        $body = $this->html->createElement('body');

        $this->html->root->appendChild($html);

        $html
            ->appendChild($head)
            ->appendChild($body);

        $this->assertNotNull($this->html->find('html', 0));
        $this->assertNotNull($this->html->find('head', 0));
        $this->assertNotNull($this->html->find('body', 0));
    }

    public function test_dom_should_find_elements_added_to_existing_dom()
    {
        $this->html->load('<html></html>');

        $head = $this->html->createElement('head');
        $body = $this->html->createElement('body');

        $this->html
            ->find('html', 0)
            ->appendChild($head)
            ->appendChild($body);

        $this->assertNotNull($this->html->find('html', 0));
        $this->assertNotNull($this->html->find('head', 0));
        $this->assertNotNull($this->html->find('body', 0));
    }

    public function test_dom_should_find_elements_added_to_existing_nested_dom()
    {
        $this->html->load('<html><body></body></html>');

        $table = $this->html->createElement('table');
        $tr = $this->html->createElement('tr');

        $this->html->find('body', 0)->appendChild($table);
        $table->appendChild($tr);

        $this->assertNotNull($this->html->find('table', 0));
        $this->assertNotNull($this->html->find('tr', 0));
    }

    public function test_dom_should_find_elements_add_in_reverse()
    {
        $html = $this->html->createElement('html');
        $head = $this->html->createElement('head');
        $body = $this->html->createElement('body');

        $html
            ->appendChild($head)
            ->appendChild($body);

        $this->html->root->appendChild($html);

        $this->assertNotNull($this->html->find('html', 0));
        $this->assertNotNull($this->html->find('head', 0));
        $this->assertNotNull($this->html->find('body', 0));
    }
}
