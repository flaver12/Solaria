<?php
namespace FM\Framework\View;

require_once APP_PATH."/framework/external/jbbcode/Parser.php";

class BBCodeParser {

    public function parse($text) {
        $text = nl2br($text);
        $parser = new \JBBCode\Parser();
        $parser->addCodeDefinitionSet(new \JBBCode\DefaultCodeDefinitionSet());
        $parser->parse($text);

        print $parser->getAsHtml();
    }

}
