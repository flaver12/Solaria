<?php
namespace FM\Framework\View;

require_once APP_PATH."/Framework/external/jbbcode/Parser.php";

class BBCodeParser {

    public function parse($text) {
        $text = nl2br($text);
        $parser = new \JBBCode\Parser();
        $parser->addCodeDefinitionSet(new \JBBCode\DefaultCodeDefinitionSet());
        $parser->parse($text);

        return $parser->getAsHtml();
    }

}
