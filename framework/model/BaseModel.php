<?php
/**
* @author Flavio Kleiber(flaver)
*
* This is a simple wrapper class for a doctrine model
*/
namespace FM\Framework\Model;

use FM\Framework\Application;

class BaseModel {

  public function save($obj) {
    $entityManager = Application::singleton('entityManager');
    $entityManager->persist($obj);
    $entityManager->flush();
    return $obj;
  }

  public function delete($obj) {
    $entityManager = Application::singleton('entityManager');
    $entityManager->remove($obj);
    $entityManager->flush();
    return $obj;
  }

  public static function findAll() {
    return self::getRepo()->findAll();
  }

  public static function findBy($search) {
    return self::getRepo()->findBy($search);
  }

  public static function find($id) {
    $entityManager = Application::singleton('entityManager');
    return $entityManager->find(get_called_class(), $id);
  }

  private static function getRepo() {
    $entityManager = Application::singleton('entityManager');
    $repo = $entityManager->getRepository(get_called_class());
    return $repo;
  }

}
