<?php

namespace AFS\Repositories;

/**
 *  Clase repositorio para usuarios.
 */
class UserRepository extends Repository 
{
    protected $table = 'users';

    public function __construct() {
        parent::__construct($this->table);
    }

    /**
    * Convierte una registro de la base de datos a una entidad. Método abstracto.
    *
    * @param array $row
    *
    * @return User
    */
    protected function rowToEntity(array $row)
    {
        $entity = new User(
          $row['fullname'],
          $row['email'],
          $row['password'],
          $row['country']
        );

        $entity->setId($row['id']);
        $entity->setImage($row['image']);

        return $entity;
    }

    public function save($user) {
        $row['id'] = $this->database->autoincrement();
        $row['fullname'] = $user->getFullname();
        $row['email'] = $user->getEmail();
        $row['password'] = $user->getPassword();
        $row['country'] = $user->getCountry();
        $row['image'] = $user->getImage();

        $this->database->insert($row);
    }

}
