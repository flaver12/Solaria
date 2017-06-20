<?php

namespace Solaria\Application\Models;

use Solaria\Framework\Application\BaseModel;

/**
 * @Entity @Table(name="page")
 **/
class Page extends BaseModel {

    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;

    /** @Column(type="string") **/
    protected $title;

    /** @Column(type="string") **/
    protected $content;

    /** @Column(type="integer") **/
    protected $enabled;

     public function getId() {
         return $this->$id;
     }

     public function getTitle() {
         return $this->title;
     }

     public function getContent() {
         return $this->content;
     }

     public function setTitle($title) {
         $this->title = $title;
     }

     public function setContent($content) {
         $this->content = $content;
     }

     public function setEnabled($enabled){
         $this->enabled = $enabled;
     }
}
