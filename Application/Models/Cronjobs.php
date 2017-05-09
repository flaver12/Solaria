<?php

namespace FM\App\Models;
use FM\Framework\Model\BaseModel;

/**
 * @Entity @Table(name="cronjobs")
 **/
class Cronjobs extends BaseModel {

    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;

    /** @Column(type="string") **/
    protected $name;

    /** @Column(type="integer") **/
    protected $priority;

     public function getId() {
         return $this->$id;
     }

     public function getName() {
         return $this->name;
     }

     public function getPriority() {
         return $this->priority;
     }

     public function setName($name) {
         $this->name = $name;
     }

     public function setPriority($priority) {
         $this->priority = $priority;
     }
}
