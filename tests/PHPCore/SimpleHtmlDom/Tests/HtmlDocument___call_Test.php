<?php

namespace PHPCore\SimpleHtmlDom\Tests;

use PHPUnit;

/**
 * Tests if __call properly forwards function calls
 */
class htmlDocument___call_test extends BaseTest
{
    function test_load_file_should_return_loadFile()
    {
        $file = TEST_DATA_PATH.'/htmldocument___call/testdata.html';

        $this->assertEquals(
            $this->html->loadFile($file),
            $this->html->load_file($file)
        );
    }

    /**
     * @expectedException PHPUnit\Framework\Error\Error
     */
    function test_unknown_function_should_return_error()
    {
        $this->expectExceptionMessage('Call to undefined method PHPCore\SimpleHtmlDom\HtmlDocument::doSomethingStupid()');
        $this->html->doSomethingStupid();
    }
}
