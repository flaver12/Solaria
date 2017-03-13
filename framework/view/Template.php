<?php

class Template {

    private $variables;
    private $renderer = null;

    public function __construct() {
        $this->variables = array();
        $this->renderer = Application::singelton('view');
    }

    public function render() {
        $this->set('view', Application::singelton('ViewHelper'));
        $this->parentTemplates();
        echo $this->renderChildes();
    }

    private function parentTemplates() {
        $this->renderer->load('base.html');
    }

    private function renderChildes() {
        $folder = Application::singelton('Dispatcher')->getController();
        $file = Application::singelton('Dispatcher')->getAction();;
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
