<?php
/**
* BaseModel, EVERY model extends form this
*
* @author Flavio Kleiber <flaverkleiber@yahoo.de>
* @copyright 2016-2017 Flavio Kleiber
*/

namespace Solaria\Framework\Core\Application;

class BaseModel {

    public function save($obj) {
        $entityManager = Application::$di->get('EntityManager');
        $entityManager->persist($obj);
        $entityManager->flush();
        return $obj;
    }

    public function delete($obj) {
        $entityManager = Application::$di->get('EntityManager');
        $entityManager->remove($obj);
        $entityManager->flush();
        return true;
    }

    public static function findAll() {
        return self::getRepo()->findAll();
    }

    public static function findBy($search) {
        return self::getRepo()->findBy($search);
    }

    public static function find($id) {
        $entityManager = Application::$di->get('EntityManager');
        return $entityManager->find(get_called_class(), $id);
    }

    private static function getRepo() {
        $entityManager = Application::$di->get('EntityManager');
        $repo = $entityManager->getRepository(get_called_class());
        return $repo;
    }

}
