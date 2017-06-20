<?php
/**
* This is our template class, we will use this as a wrapper for twig
*
* @author Flavio Kleiber <flaverkleiber@yahoo.de>
* @copyright 2016-2017 Flavio Kleiber
*/

namespace Solaria\Framework\View;
use Solaria\Framework\Core\DiClass;
use Exception;

class Template extends DiClass{

    private $variables;
    private $renderer = null;
    private $renderView = true;

    public function __construct() {
        parent::__construct();
        $this->variables = array();
        $this->renderer = $this->di->get('View');
    }

    public function render() {
        if($this->renderView) {
            $this->set('Tag', $this->di->get('Solaria\Framework\View\Tag'));
            //$this->set('flashSession', Application::singleton('Solaria\Framework\View\Flash\SessionFlash'));
            //$this->set('url', Url::getBaseURL());
            $this->parentTemplates();
            echo $this->renderChildes();
            return;
        } else {
            return;
        }
    }
    private function parentTemplates() {
        //$this->renderer->load('base.html');
    }
    private function renderChildes() {
        $module = $this->di->get('Dispatcher')->getModule();
        $controller = $this->di->get('Dispatcher')->getController();
        $action = $this->di->get('Dispatcher')->getAction();
        return $this->renderer->render('@'.$module.'/'.$controller.'/'.$action.'.html',$this->prepVars());
    }
    private function prepVars() {
        return $this->variables;
    }
    public function set($name, $value) {
        $this->variables[$name] = $value;
    }
    public function noRenderer() {
        $this->renderView = false;
    }
}
