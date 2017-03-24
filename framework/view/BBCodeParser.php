<?php

class BBCodeParser {

    public function parse($text) {
        $parser = new JBBCode\Parser();
        $parser->addCodeDefinitionSet(new JBBCode\DefaultCodeDefinitionSet());
        $parser->parse($text);

        print $parser->getAsHtml();
    }

}
