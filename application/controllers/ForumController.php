<?php
namespace FM\App\controllers;

use FM\Framework\Controller\BaseController;
use FM\App\Models\Category;
use FM\App\Forms\BBCodeForm;
use FM\App\Models\Topic;
use FM\App\Models\Post;
use FM\App\Models\User;
use FM\Framework\Session;

 class ForumController extends BaseController {

  	public function indexAction(){
          $this->set('categories', Category::findAll());
      }

    public function viewTopicAction($id) {

        //load topic
        $topic = Topic::find($id);

        //created breadcrumbs
        $breadcrumbs = array(
          0 => array(
              'name' => $topic->getCategory()->getName(),
              'link' => 'forum'
          ),

          1 => array(
              'name' => $topic->getName(),
              'link' => 'forum/view-topic/'.$topic->getId()
          )

        );
        $this->set('breadcrumb', $breadcrumbs);
        $this->set('topic', $topic);
        $this->set('bbCodeForm', new BBCodeForm('forum/create-post'));
    }

    public function viewPostAction($id) {

        //Load form
        $this->set('bbCodeForm', new BBCodeForm('forum/create-response'));

        //load post
        $post = Post::find($id);

        //load response
        $response = $post->getPost();

        //created breadcrumbs
        $breadcrumbs = array(
          0 => array(
              'name' => $post->getTopic()->getCategory()->getName(),
              'link' => 'forum'
          ),

          1 => array(
              'name' => $post->getTopic()->getName(),
              'link' => 'forum/view-topic/'.$post->getTopic()->getId()
          ),

          2 => array(
              'name' => $post->getTitle(),
              'link' => 'forum/view-post/'.$post->getId()
          )

        );
        //\Doctrine\Common\Util\Debug::dump($post->getPost()[0]->getTitle());die;

        $this->set('topic_id', $post->getTopic()->getId());
        $this->set('breadcrumb', $breadcrumbs);
        $this->set('post', $post);
        $this->set('response', $response);
    }

    public function createPostAction() {
        $this->view->noRenderer();
        if($this->request->isPost()) {

            $post = new Post();
            $post->setTitle('NOT IMPLEMENTED');
            $post->setContent($this->request->getPost('content'));
            $post->setTopic(Topic::find($this->request->getPost('topic_id')));

            //AS_TODO: Find out what this shit is!!!!
            $post->setUser(User::find(Session::get('user')[0]->getId()));
            $post->save($post);

            return;
        }
    }

    public function createResponseAction() {
        $this->view->noRenderer();
        if($this->request->isPost()) {

            $post = new Post();
            $post->setTitle('NOT IMPLEMENTED-Response');
            $post->setContent($this->request->getPost('content'));
            $post->setTopic(Topic::find($this->request->getPost('topic_id')));

            //AS_TODO: Find out what this shit is!!!!
            $post->setUser(User::find(Session::get('user')[0]->getId()));
            $post->setResponse(Post::find($this->request->getPost('post_id')));
            $post->save($post);

            $this->response->redirect('/forum/view-post/'.$this->request->getPost('post_id'));
            return;
        }
    }


}
