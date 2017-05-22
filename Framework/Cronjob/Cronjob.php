<?php

namespace Solaria\Framework\Cronjob;

use Solaria\Framework\Application;

abstract class Cronjob {

    public function __construct() {}

    public abstract function run();

    protected function register($instanceOfCron) {
        Application::singleton('Solaria\Framework\Cronjob\CronjobHandler')->register($instanceOfCron);
    }

}
