<?php

namespace FM\App\Controllers;

use FM\Framework\Controller\BaseController;
use FM\Framework\Cronjob\Cronjobs\TestCronjob;
use FM\Framework\Application;

class IndexController extends BaseController {

    public function indexAction() {
        $test = new TestCronjob();
        Application::singleton('FM\Framework\Cronjob\CronjobHandler')->runCrons();
    }

    public function testAction() {
        printf("Hello world2!");
    }

}
