<?php
/**
+------------------------------------------------------------------------+
| dev-storm.com                                                          |
+------------------------------------------------------------------------+
| Copyright (c) 2014 dev-storm.com Team                                  |
+------------------------------------------------------------------------+
| @author flaver <flaver@dev-storm.com>                                  |
| @copyright flaver, dev-storm.com                                       |
| @package devstorm.controllers                                          |
| @desc Forum page                                                       |
+------------------------------------------------------------------------+
 */
namespace devStorm\Controllers;
use devStorm\Controllers\BaseController;
use devStorm\Models\Thread;
use devStorm\Library\Error\Notification;
use devStorm\Models\Post as ForumPost;
use devStorm\Library\BBCode\BBCodeParser;

class ForumController extends BaseController {

    public function indexAction() {
        $this->tag->prependTitle("&hearts; Forum - ");
        $threads = Thread::find();
        if($threads !== false || empty($threads)) {
            $this->view->threads = $threads;
        }
    }

    public function threadAction($id) {
        if(!isset($id)) {
            $this->response->redirect('');
        }
        $thread = Thread::findFirst(array('id = :id:', 'bind'   => array('id' => $id)));
        if($thread !== false) {
            $posts = ForumPost::find(array('thread_id = :thread_id: AND deleted = 0 AND hidden = 0 AND replay = 0', 'bind' => array('thread_id' => $id)));
            $this->view->thread = $thread;
            $this->tag->prependTitle("&hearts; Forum - ".$thread->name.' - ');
            if($posts !== false) {
                $this->view->posts = $posts;
            } else {
                $this->view->beFirst = true;
            }
        }
    }

    public function viewPostAction($thread_id, $post_id) {
        $post = ForumPost::findFirst($post_id);
        if($post !== false) {
            $parser = new BBCodeParser();
            $replays = ForumPost::find(array('replay = :post:', 'bind' => array('post' => $post_id)));
            $i = 0;
            foreach($replays as $replay) {
                $user = $replay->getUser();
                $replayResult[$i] = $replay->toArray();
                $replayResult[$i]['body'] = $parser->parse($replayResult[$i]['body']);
                $replayResult[$i]['userObj'] = $user->toArray();
                $i ++;
            }
            $this->view->replays = $replayResult;
            $this->view->user = $post->getUser();
            $this->view->parsedContent = $parser->parse($post->body);
            $this->view->post = $post;
            $this->tag->prependTitle("&hearts; Forum - ".$post->title.' - ');
        } else {
            $this->flashSession->error(Notification::ERROR_OOPS);
        }
    }

    public function createAction($create = null, $category_id = null) {
        if($this->session->has('auth') && !is_null($category_id) && !is_null($create) && $this->request->isPost()) {
            $post = new ForumPost();
            $auth = $this->session->get('auth');
            if($create == 'post') {
                    $post->category_id = 0;
                    $post->thread_id = $category_id;
            } else if($create == 'post'){
                $post->category_id = $category_id;
                $post->thread_id = 0;
            } else {
                $this->flashSession->error(Notification::ERROR_OOPS);
            }
            $post->title = $this->request->getPost("title", "striptags");
            $post->body = $this->request->getPost("body");
            $post->user_id = $auth['id'];
            $post->created = time();
            $post->deleted = 0;
            $post->hidden = 0;
            $post->visible = 1;
            $post->replay = 0;
            if($post->create() !== false) {
                $this->flashSession->success('Der Post wurde gespeichert!');
                $this->dispatcher->forward(array(
                    "controller" => "index",
                    "action" => "index"
                ));
            } else {
                foreach ($post->getMessages() as $message) {
                    echo $message, "\n";
                }die;
            }
        } else {
            $this->falshSession->error(Notification::ERROR_OOPS);
        }
    }

    public function replayAction($thread_id, $replayTo) {
        if($this->request->isPost()) {
            $auth = $this->session->get('auth');
            $replay = new ForumPost();
            $replay->title = " ";
            $replay->category_id = 0;
            $replay->thread_id = $thread_id;
            $replay->body = $this->request->getPost("body");
            $replay->user_id = $auth['id'];
            $replay->created = time();
            $replay->deleted = 0;
            $replay->hidden = 0;
            $replay->visible = 1;
            $replay->replay = $replayTo;
            if($replay->create() !== false) {
                $this->flashSession->success('Der Post wurde gespeichert!');
                $this->response->redirect('forum/view-post/'.$thread_id.'/'.$replayTo);
            } else {
                foreach ($replay->getMessages() as $message) {
                    echo $message, "\n";
                }die;
            }
        }
    }
}
?>
