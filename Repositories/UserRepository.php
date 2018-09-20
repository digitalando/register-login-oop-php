<?php

namespace AFS\Repositories;

/**
 *  Clase repositorio para usuarios
 */
class UserRepository extends Repository {

  /**
   *
   */
  protected function rowToEntity(array $row)
  {
      $entity = new Usuario(
          $row['first_name'],
          $row['last_name'],
          $row['email'],
          $row['password'],
      );

      $entity->setId($row['id']);
      $entity->setImage($row['image']);

      return $entity;
  }

  public function save($user) {
    
  }
}
