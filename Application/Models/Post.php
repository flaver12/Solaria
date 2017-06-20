<?php

namespace Solaria\Application\Models;

use Solaria\Framework\Application\BaseModel;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="post")
 **/
class Post extends BaseModel {

    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;

    /** @Column(type="integer") **/
    protected $topic_id;

    /** @Column(type="integer") **/
    public $user_id;

    /** @Column(type="integer") **/
    protected $post_id;

    /** @Column(type="string") **/
    public $title;

    /** @Column(type="string") **/
    public $content;

  /**
   * Many Posts have One Topic.
   * @ManyToOne(targetEntity="Solaria\App\Models\Topic", inversedBy="posts")
   * @JoinColumn(name="topic_id", referencedColumnName="id")
   */
   protected $topic;

   /**
    * Many Posts have One User.
    * @ManyToOne(targetEntity="Solaria\App\Models\User")
    * @JoinColumn(name="user_id", referencedColumnName="id")
    */
    protected $user;

    /**
     * One Category has Many Categories.
     * @OneToMany(targetEntity="Solaria\App\Models\Post", mappedBy="response")
     */
    protected $post = null;

    /**
     * Many Responses have One Post.
     * @ManyToOne(targetEntity="Solaria\App\Models\Post", inversedBy="post")
     * @JoinColumn(name="post_id", referencedColumnName="id")
     */
    protected $response = null;

   public function __construct() {
     $this->topic = new ArrayCollection();
     $this->user = new ArrayCollection();
     $this->post = new ArrayCollection();
   }

   public function getId() {
     return $this->id;
   }

   public function getResponse() {
     return $this->response;
   }

   public function getPost() {
     return $this->post;
   }

   public function getTopicId() {
     return $this->topic_id;
   }

   public function getUserId() {
     return $this->user_id;
   }

   public function getPostId() {
     return $this->post_id;
   }

   public function getTitle() {
     return $this->title;
   }

   public function getContent() {
     return $this->content;
   }

   public function getTopic() {
     return $this->topic;
   }

   public function getUser() {
     return $this->user;
   }

   public function setTopic($topic) {
     $this->topic = $topic;
   }

   public function setUser($user) {
     $this->user = $user;
   }

   public function setTopicId($topic_id) {
     $this->topic_id = $topic_id;
   }

   public function setUserId($user_id) {
     $this->user_id = $user_id;
   }

   public function setTitle($title) {
     $this->title = $title;
   }

   public function setContent($content) {
     $this->content = $content;
   }

   public function setResponse($response) {
     $this->response = $response;
   }

}
