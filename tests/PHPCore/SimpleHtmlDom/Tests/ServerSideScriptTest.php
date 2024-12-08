<?php

namespace PHPCore\SimpleHtmlDom\Tests;

/**
 * Checks if the parser properly handles server-side scripts
 */
class serverSideScriptTest extends BaseTest
{
    public function test_html_inside_sss_should_not_appear_in_the_dom()
    {
        $this->html->load('<?php <div>Hello, World!</div> ?>');
        $this->assertNull($this->html->find('div', 0));
    }
}
