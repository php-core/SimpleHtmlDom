<?php

namespace PHPCore\SimpleHtmlDom\Tests;

/**
 * Tests the callback feature of the parser
 */
class callbackTest extends BaseTest
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->html->set_callback(
            function ($element) {
                $element->tag = 'surprise';
            }
        );
    }

    public function test_htmldocument_set_callback_should_register_function()
    {
        $this->assertNotNull($this->html->callback);
    }

    public function test_htmldocument_remove_callback_should_unregister_function()
    {
        $this->html->remove_callback();
        $this->assertNull($this->html->callback);
    }

    public function test_htmlnode_outertext_uses_callback_function()
    {
        $expected = '<surprise></surprise>';
        $this->html->load('<html></html>');
        $this->assertEquals($expected, $this->html->save());
    }
}
