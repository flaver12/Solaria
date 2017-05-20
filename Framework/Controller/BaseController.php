<?php
//by flaver

namespace Solaria\Framework\Controller;

use Solaria\Framework\Url\Url;
use Solaria\Framework\Application;
use Solaria\Framework\Session;
use Solaria\Framework\Acl\Acl;
use Solaria\App\Models\Cronjobs;

class BaseController {

    protected $request;
    protected $view;
    protected $response;
    protected $acl;
    protected $flashSession;

    public function __construct() {
        $this->request = URL::getRequest();
        $this->view = Application::singleton('Solaria\Framework\View\Template');
        $this->response = Application::singleton('Solaria\Framework\Url\Response');
        $this->flashSession = Application::singleton('Solaria\Framework\View\Flash\SessionFlash');
        if(Session::exist('user')) {
            $this->set('user', Session::get('user'));
        }
        $this->acl = new Acl();
        if(!URL::isAdmin()) {
            $this->runCrons();
        }
    }

    public function __destruct() {
        Application::singleton('Solaria\Framework\View\Template')->render();
    }

    protected function set($name, $value) {
        Application::singleton('Solaria\Framework\View\Template')->set($name, $value);
    }

    protected function noRenderer() {
        Application::singleton('Solaria\Framework\View\Template')->noRenderer();
    }

    protected function runCrons() {
        $crons = Cronjobs::findAll();
        foreach ($crons as $cron) {
            Application::singleton('Solaria\Framework\Cronjob\CronjobHandler')->register(Application::singleton('Solaria\Framework\Cronjob\Cronjobs\\'.$cron->getName()));
        }
        Application::singleton('Solaria\Framework\Cronjob\CronjobHandler')->runCrons();
    }
}
