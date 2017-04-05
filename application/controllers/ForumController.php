<?php
namespace FM\App\controllers;

use FM\Framework\controller\BaseController;

 class ForumController extends BaseController {

	public function indexAction(){
        $this->set('categories', Category::getAllWithTopics());
    }

    public function viewTopicAction($id) {
        $this->set('breadcrumb', Topic::getBreadcrum());
        $this->set('topic', Topic::getWithPosts($id));
        $this->set('bbCodeForm', new BBCodeForm());
    }

    public function viewPostAction($id) {
        $this->set('breadcrumb', Post::getBreadcrum());
        $this->set('post',Post::get('id = '.$id)->getFirst());
    }

    public function createPostAction() {
        $this->view()->noRenderer();
        if($this->request->isPost()) {
            echo "<pre>";
            Application::singleton('BBCodeParser')->parse($this->request->getPost('content'));
            var_dump($this->request->getPost('content'));die;
            return;
        }
    }


}
