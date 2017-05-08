<?php

namespace FM\Framework\Cronjob;

use FM\Framework\Application;

abstract class Cronjob {

    public function __construct() {}

    public abstract function run();

    protected function register($instanceOfCron) {
        Application::singleton('FM\Framework\Cronjob\CronjobHandler')->register($instanceOfCron);
    }

}
