<?php
/**
* BaseController, EVERY controller extends form this
*
* @author Flavio Kleiber <flaverkleiber@yahoo.de>
* @copyright 2016-2017 Flavio Kleiber
*/

namespace Solaria\Framework\Application;

use Solaria\Framework\Core\DiClass;
use Solaria\Framework\View\Template;

class BaseController extends DiClass {

    protected $session;
    protected $view;
    protected $di;

    public function __construct() {
        parent::__construct();
        $this->session = $this->di->get('Session');
        $this->view = new Template();
    }

    public function __destruct() {
        $this->view->render();
    }

}
