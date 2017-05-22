<?php

namespace Solaria\Framework\Cronjob;

use Solaria\Framework\Cronjob\Cronjob;
use Exception;

class CronjobHandler {

    private $cronsToRun = array();

    public function __construct() {}

    public function register($cronJob) {
        if($cronJob instanceof Cronjob) {
            array_push($this->cronsToRun, $cronJob);
        } else {
            throw new Exception("The class ".get_class($cronJob). " is not a valid Cronjob class!");
        }
    }

    public function runCrons() {
        foreach ($this->cronsToRun as $cron) {
            $cron->run();
        }
    }

}
