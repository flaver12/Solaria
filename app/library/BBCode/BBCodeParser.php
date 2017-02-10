<?php
/**
+------------------------------------------------------------------------+
| dev-storm.com                                                          |
+------------------------------------------------------------------------+
| Copyright (c) 2014 dev-storm.com Team                                  |
+------------------------------------------------------------------------+
| @author flaver <flaver@dev-storm.com>                                  |
| @copyright flaver, dev-storm.com                                       |
| @package devstorm.bbcode                                               |
| @desc bbcode parser for our posts                                      |
+------------------------------------------------------------------------+
 */
namespace devStorm\Library\BBCode;
use \JBBCode\Parser;

class BBCodeParser {

    public function __construct() {
        $this->parser = new \JBBCode\Parser();
        $this->parser->addCodeDefinitionSet(new \JBBCode\DefaultCodeDefinitionSet());
    }

    public function parse($string) {
        $this->parser->parse($string);
        $html = $this->parser->getAsHtml();
        return $html;
    }
}
?>
