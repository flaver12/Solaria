<?php
namespace FM\App\Controllers;

use FM\Framework\Controller\BaseController;
use FM\Framework\Acl\Acl;

use FM\App\Models\User;
use FM\App\Models\UserRole;
use FM\App\Models\Role;
use FM\App\Models\RolePermission;
use FM\App\Models\Post;
use FM\App\Models\Topic;
use FM\App\Models\Permission;
use FM\App\Models\Category;
use FM\App\Models\Resource;
use FM\App\Models\ResourceRole;
use FM\App\Forms\CategoryCreationForm;
use FM\App\Forms\CreateTopicForm;
use FM\App\Forms\CreateUserGroup;

class AdminController extends BaseController {

    const VIEW_TOPIC = 'viewTopicAction';
    const DELETE_POST = 'deletePostAction';
    const EDIT_POST = 'editPostAction';
    const DEFAULT_PERMISSION = 1;

    public function __construct() {
        parent::__construct();
        $this->set('user_count', count(User::findAll()));
        $this->set('post_count', count(Post::findAll()));
        $this->set('topic_count', count(Topic::findAll()));
    }

    public function indexAction() {
    }

    public function editForumAction() {
        //load category and build array
        $cats = Category::findAll();
        $catArr = array();
        foreach ($cats as $category) {
            $catArr[$category->getName()] = $category->getId();
        }
        //load groups and build array
        $roles = Role::findAll();
        $roleArr = array();
        foreach ($roles as $role) {
            $roleArr[$role->getName()] = $role->getId();
        }

        $this->set('topics', Topic::findAll());
        $this->set('catform', new CategoryCreationForm());
        $this->set('topicform', new CreateTopicForm($catArr, $roleArr));
    }

    public function userPermissionAction() {
        $allUsers = User::findAll();
        $userRoles = array();

        //load all permissions
        $permissions = Permission::findAll();
        $perArr = array();

        foreach ($permissions as $permission) {
            $perArr[$permission->getName()] = $permission->getId();
        }

        foreach ($allUsers as $user) {
            $roles = UserRole::findBy(array('user_id' => $user->getId()));
            $userRoles[$user->getUsername()] = array();
            foreach ($roles as $role) {
                $userRoles[$user->getUsername()][$role->getRole()->getId()] = $role->getRole()->getName();
            }
        }

        $this->set('users', $allUsers);
        $this->set('userGroups', $userRoles);
        $this->set('user_group_form', new CreateUserGroup($perArr));
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

    public function createCategoryAction() {
        if($this->request->isPost()) {
            $cat = new Category();
            $cat->setName($this->request->getPost('name'));
            $cat->save($cat);
            $this->response->redirect('admin');
        }
    }

    public function createTopicAction() {
        if($this->request->isPost()) {
            $topic = new Topic();
            $topic->setCategory(Category::find($this->request->getPost('category')));
            $topic->setName($this->request->getPost('name'));
            $topic->save($topic);
            $tempArr = $this->request->getPost();
            unset($tempArr['name']);
            unset($tempArr['category']);

            if(!empty($tempArr)) {
                $res = new Resource();
                $res->setPermission(Permission::find(self::DEFAULT_PERMISSION));
                $res->setName(self::VIEW_TOPIC.'.'.$topic->getId());
                $res->save($res);
                foreach ($tempArr as $name => $id) {
                    $resRole = new ResourceRole();
                    $resRole->setResource($res);
                    $resRole->setRole(Role::find($id));
                    $resRole->save($resRole);
                }
            }

            $this->response->redirect('admin');
        }
        $this->response->redirect('admin');
    }

    public function createGroupAction() {
        if($this->request->isPost()) {
            $role = new Role();
            $role->setName($this->request->getPost('name'));
            $role->save($role);
            $tempArr = $this->request->getPost();
            unset($tempArr['name']);

            if(!empty($tempArr)) {
                foreach ($tempArr as $name => $id) {
                    $rolePer = new RolePermission();
                    $rolePer->setRole($role);
                    $rolePer->setPermission(Permission::find($id));
                    $rolePer->save($rolePer);
                }

            }

            $this->response->redirect('admin/user-permission');

        } else {
            $this->response->redirect('admin');
        }
    }

    public function editTopicPermissionAction($id = null) {
        if($this->request->isPost()) {
            $topicId = $this->request->getPost('topic_id');
            $data = $this->request->getPost();
            unset($data['topic_id']);
            $resource = Resource::findBy(array('name' => self::VIEW_TOPIC.'.'.$topicId));

            if(!empty($resource) && count($data) > 1) {
                $resourceRoles = $resource[0]->getResourceRole();
                $res = $resource[0];
                //we do it simple at the moment, we remove all roles
                //than we add the checked one, need to be redone soon!
                foreach ($resourceRoles as $role) {
                    ResourceRole::delete($role);
                }

                foreach ($data as $name => $id) {
                    $resRole = new ResourceRole();
                    $resRole->setResource($res);
                    $resRole->setRole(Role::find($id));
                    $resRole->save($resRole);
                }
            } else if(count($data) < 1 && !empty($resource)) {
                $resourceRoles = $resource[0]->getResourceRole();
                //we do it simple at the moment, we remove all roles
                //than we add the checked one, need to be redone soon!
                foreach ($resourceRoles as $role) {
                    ResourceRole::delete($role);
                }
                Resource::delete($resource[0]);

                $this->response->redirect('admin/edit-forum');
            } else {
                $res = new Resource();
                $res->setPermission(Permission::find(self::DEFAULT_PERMISSION));
                $res->setName(self::VIEW_TOPIC.'.'.$topicId);
                $res->save($res);
                foreach ($data as $name => $id) {
                    $resRole = new ResourceRole();
                    $resRole->setResource($res);
                    $resRole->setRole(Role::find($id));
                    $resRole->save($resRole);
                }
            }



            $this->response->redirect('admin/edit-forum');
        } else {

            $topic = Topic::find($id);
            $roles = Role::findAll();
            $resArr = array();
            $resGroups = array();
            $resource = Resource::findBy(array('name' => self::VIEW_TOPIC.'.'.$id));

            if(empty(!$resource)) {

                foreach ($resource as $res) {
                    $resRoles = $res->getResourceRole();
                    foreach ($resRoles as $resRole) {
                        $resGroups[$resRole->getRole()->getName()] = $resRole->getRole()->getId();
                    }
                }

            }

            foreach ($roles as $role) {
                array_push($resArr, $role);
            }

            $this->set('topic', $topic);
            $this->set('res', $resArr);
            $this->set('resGroup', $resGroups);
        }
    }

}
