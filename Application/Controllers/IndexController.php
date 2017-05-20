<?php

namespace Solaria\App\Controllers;

use Solaria\Framework\Controller\BaseController;
use Solaria\Framework\Cronjob\Cronjobs\TestCronjob;
use Solaria\Framework\Application;

use Solaria\Framework\Acl\Acl;
use Solaria\Framework\Acl\Role;
use Solaria\Framework\Acl\Resource;

class IndexController extends BaseController {

    public function indexAction() {
        $acl = new Acl();
        $acl->addRole(new Role('Guest'));
        $acl->addResource(new Resource('Users'), array(Acl::READ, ACL::WRITE));
        $acl->allow('Guest', 'Users', Acl::READ);

        echo $acl->isAllowed('Guest', 'Users', Acl::READ);
        echo "<br />";
        echo $acl->isAllowed('Guest', 'Users', Acl::WRITE);
    }

}
