<?php

namespace FM\Framework\Cronjob\Cronjobs;

use FM\Framework\Cronjob\Cronjob;

class TestCronjob extends Cronjob {

    public function run() {
        echo "test!";
    }
}
