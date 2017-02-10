<?php

namespace Test;

/**
 * Class UnitTest
 */
class UnitTest extends \UnitTestCase
{

    public function testBBCodeParserOutput() {
        $parser = new \devStorm\Library\BBCode\BBCodeParser();
        $input = '[b]hello world![/b]';
        $expected = '<strong>hello world!</strong>';
        $this->assertEquals($expected, $parser->parse($input));
    }
}