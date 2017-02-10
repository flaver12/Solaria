<?php
//This is a little bitchi class ;)

namespace devStorm\Models;
use Phalcon\Mvc\Model;

class BaseModel extends Model {

    /**
        * Phalcon __construct event
        *
        * @return void
        */
       public function onConstruct() {
           Model::setup(array(
               'notNullValidations' => false
           ));
       }

}
