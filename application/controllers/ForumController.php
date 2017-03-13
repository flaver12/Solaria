<?php
 //generate by fm-cli
 class ForumController extends BaseController {

	public function indexAction(){

        //just test data
        $posts = array(
            0 => array(
                'name' => 'My first post',
                'created' => '12.12.12',
                'username' => 'test'
            ),
            1 => array(
                'name' => 'My first post',
                'created' => '12.12.12',
                'username' => 'test'
            ),

            2 => array(
                'name' => 'My first post',
                'created' => '12.12.12',
                'username' => 'test'
            ),


        );

        $this->set('posts', $posts);

    }

}
