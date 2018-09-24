<?php

namespace AFS\Repositories;

/**
 *  Clase repositorio de usuarios.
 */
class UserRepository extends Repository 
{
    protected $table = 'users';

    /**
    * Convierte una registro de la base de datos a una entidad.
    *
    * @param array $row
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

    /**
     * Guarda el usuario en la base de datos.
     * 
     * @param  User $user
     * @return void
     */
    public function save($user) {
        $row['id'] = $this->database->autoincrement();
        $row['fullname'] = $user->getFullname();
        $row['email'] = $user->getEmail();
        $row['password'] = $user->getPassword();
        $row['country'] = $user->getCountry();
        $row['image'] = $user->getImage();

        $this->database->insert($row);
    }

    /**
     * Retorna el primer resultado que cumpla la condición dada.
     * 
     * @param  string $field
     * @param  string $value
     * @return User
     */
    public function fetchByField(string $field, string $value) {
        if ($this->database->fetch([$field => $value])) {
            return $this->rowToEntity($row);
        }
        else {
            return false;
        }
    }

    /**
     * Verifica si el email existe en base de datos.
     * 
     * @param  string $email
     * @return boolean
     */
    public function emailExists(string $email) {
        if ($this->database->fetch(['email' => $email])) {
            return true;
        }
        else {
            return false;
        }   
    }
}
