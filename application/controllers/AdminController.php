<?php
namespace FM\App\Controllers;

use FM\Framework\Controller\BaseController;
use FM\Framework\Acl\Acl;

use FM\App\Models\User;
use FM\App\Models\UserRole;
use FM\App\Models\Role;

class AdminController extends BaseController {

    public function indexAction() {
        echo 1; die;
    }

    public function userPermissionAction() {
        $allUsers = User::findAll();
        $userRoles = array();

        foreach ($allUsers as $user) {
            $roles = UserRole::findBy(array('user_id' => $user->getId()));
            $userRoles[$user->getUsername()] = array();
            foreach ($roles as $role) {
                $userRoles[$user->getUsername()][$role->getRole()->getId()] = $role->getRole()->getName();
            }
        }

        $this->set('users', $allUsers);
        $this->set('userGroups', $userRoles);
    }

    public function editUserAction($id) {
        if($this->request->isPost()) {

            if(count($this->request->getPost()) == 1) {
                //check if we have to delete some groups
                $roles = UserRole::findBy(array('user_id' => $this->request->getPost('user_id')));
                if(!empty($roles)) {
                    foreach ($roles as $role) {
                        UserRole::delete($role);
                    }
                }

                $this->response->redirect('admin/user-permission');
            } else {
                $post = $this->request->getPost();
                $userId = $post['user_id'];
                unset($post['user_id']);
                $roles = UserRole::findBy(array('user_id' => $this->request->getPost('user_id')));
                if(empty($roles)) {
                    foreach ($post as $key => $value) {
                        $userRole = new UserRole();
                        $userRole->setRole(Role::find($value));
                        $userRole->setUser(User::find($userId));
                        $userRole->save($userRole);
                    }
                } else {

                    //we do it simple at the moment, we remove all roles
                    //than we add the checked one, need to be redone soon!
                    foreach ($roles as $role) {
                        UserRole::delete($role);
                    }

                    foreach ($post as $key => $value) {
                        $userRole = new UserRole();
                        $userRole->setRole(Role::find($value));
                        $userRole->setUser(User::find($userId));
                        $userRole->save($userRole);
                    }
                }
                $this->response->redirect('admin/user-permission');
            }
        } else {
            $user = User::find($id);
            $this->set('editUser', $user);

            $acl = new Acl($user);
            $this->set('userGroups',$acl->getRole());
            $this->set('allGroups', Role::findAll());
        }
    }

}
