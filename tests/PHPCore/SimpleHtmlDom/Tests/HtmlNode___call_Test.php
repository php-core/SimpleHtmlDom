<?php

namespace PHPCore\SimpleHtmlDom\Tests;

use PHPUnit;

/**
 * Tests if __call properly forwards function calls
 */
class htmlNode___call_test extends BaseTest
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->html->load('<html><head /><body /></html>');
    }

    function test_children_should_return_childNodes()
    {
        $this->assertEquals($this->html->root->childNodes(), $this->html->root->children());
        $this->assertEquals($this->html->root->childNodes(0), $this->html->root->children(0));
        $this->assertEquals($this->html->root->childNodes(1), $this->html->root->children(1));
    }

    function test_first_child_should_return_firstChild()
    {
        $this->assertEquals(
            $this->html->root->firstChild(),
            $this->html->root->first_child()
        );
    }

    function test_has_child_should_return_hasChildNodes()
    {
        $this->assertEquals(
            $this->html->root->hasChildNodes(),
            $this->html->root->has_child()
        );
    }

    function test_last_child_should_return_lastChild()
    {
        $this->assertEquals(
            $this->html->root->lastChild(),
            $this->html->root->last_child()
        );
    }

    function test_next_sibling_should_return_nextSibling()
    {
        $this->assertEquals(
            $this->html->find('head', 0)->nextSibling(),
            $this->html->find('head', 0)->next_sibling()
        );
    }

    function test_prev_sibling_should_return_previousSibling()
    {
        $this->assertEquals(
            $this->html->find('body', 0)->previousSibling(),
            $this->html->find('body', 0)->prev_sibling()
        );
    }

    /**
     * @expectedException PHPUnit\Framework\Error\Error
     */
    function test_unknown_function_should_return_error()
    {
        $this->expectExceptionMessage('Call to undefined method PHPCore\SimpleHtmlDom\HtmlNode::doSomethingStupid()');
        $this->html->root->doSomethingStupid();
    }
}
