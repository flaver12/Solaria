<?php

class Template {

    private $variables;
    private $renderer = null;

    public function __construct() {
        $this->variables = array();
        $this->renderer = Application::singelton('renderer');
    }

    public function render() {
        $this->set('basePath', URL::getBaseURL());
        $this->parentTemplates();
        echo $this->renderChildes();
    }

    private function parentTemplates() {
        $this->renderer->load('base.html');
    }

    private function renderChildes() {
        $folder = URL::getController();
        $file = URL::getAction();
        $template = $this->renderer->load($folder.'/'.$file.'.html');
        return $template->render($this->prepVars());
    }

    private function prepVars() {
        return $this->variables;
    }

    public function set($name, $value) {
        $this->variables[$name] = $value;
    }



}
