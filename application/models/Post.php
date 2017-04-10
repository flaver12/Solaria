<?php

namespace FM\App\models;
use FM\Framework\model\BaseModel;
/**
 * @Entity @Table(name="post")
 **/
class Post extends BaseModel {

  /** @Id @Column(type="integer") @GeneratedValue **/
  protected $id;

  /** @Column(type="integer") **/
  protected $topic_id;

  /** @Column(type="string") **/
  protected $title;

  /** @Column(type="string") **/
  protected $content;

  /**
   * Many Posts have One Topic.
   * @ManyToOne(targetEntity="FM\App\models\Topic")
   * @JoinColumn(name="topic_id", referencedColumnName="id")
   */
   protected $topic;

   public function __construct() {
     $this->topic = new ArrayCollection();
   }

   public function getId() {
     return $this->id;
   }

   public function getTopicId() {
     return $this->topic_id;
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

}
