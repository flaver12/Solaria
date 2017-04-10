<?php
namespace FM\App\controllers;

use FM\Framework\Controller\BaseController;
use FM\App\Models\Category;
use FM\App\Forms\BBCodeForm;
use FM\App\Models\Topic;
use FM\App\Models\Post;

 class ForumController extends BaseController {

	public function indexAction(){
        $this->set('categories', Category::findAll());
    }

    public function viewTopicAction($id) {
      /*
        $this->set('breadcrumb', Topic::getBreadcrum());*/
        $this->set('topic', Topic::find($id));
        $this->set('bbCodeForm', new BBCodeForm());
    }

    public function viewPostAction($id) {
        //load post
        $post = Post::find($id);

        //created breadcrumbs
        $breadcrumbs = array(
          0 => array(
              'name' => $post->getTopic()->getCategory()->getName(),
              'link' => 'forum'
          ),

          1 => array(
              'name' => $post->getTopic()->getName(),
              'link' => 'forum/view-topic/'.$post->getTopic()->getId()
          )

        );
        $this->set('breadcrumb', $breadcrumbs);
        $this->set('post',Post::find($id));
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
