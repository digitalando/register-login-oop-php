<?php

namespace AFS\Entitites;

/**
 * User Entity
 *
 * Esta clase provee la entidad de usuarios.
 */
class User {

  /**
   * @var int
   */
  private $id;

  /**
   * @var string
   */
  private $fullname;

  /**
   * @var string
   */
  private $email;

  /**
   * @var string
   */
  private $password;

  /**
   * @var string
   */
  private $country;

  /**
   * @var string
   */
  private $image;

  public function __construct($fullname, $email, $password, $country, $image) {
    $this->fullname = $fullname;
    $this->email = $this->setEmail($email);
    $this->password = $this->setPassword($password);
    $this->country = $country;
    $this->image = $image;
  }

  /**
   * Setea el parámetro id
   *
   * @param int
   */
  public function setImage($id) {
    $this->id = $id;
  }


  /**
   * Setea el parámetro fullname
   *
   * @param string
   */
  public function setFullname($fullname) {
    $this->fullname = $fullname
  }

  /**
   * Setea el parámetro email
   *
   * La función también quitará los espacios adicionales y transformará el email a minúsculas.
   *
   * @param string
   */
  public function setEmail($email) {
    $this->email = trim(strtolower($email);
  }

  /**
   * Setea el parámetro password
   *
   * La función utiliza el método de password_hash
   *
   * @param string $password
   */
  public function setPassword($password) {
    /* Si el password ya fue hasheado lo guardamos como está */
    if (passwordIsHashed($password) == false) {
      $password = password_hash($password, PASSWORD_DEFAULT);
    }

    $this->password = $password;
  }

  /**
   * Chequea si un password ya fue hasheado anteriormente
   *
   * Fuentes:
   * - http://php.net/manual/en/function.password-get-info.php
   *
   * @param string $password
   * @return boolean
   */
  private function passwordIsHashed($password) {
    $info = password_get_info($password);
    
    return $info['algo'] != 0;
  }

  /**
   * Setea el parámetro fullname
   *
   * @param string
   */
  public function setCountry($country) {
    $this->country = $country;
  }

  /**
   * Setea el parámetro fullname
   *
   * @param string
   */
  public function setImage($image) {
    $this->image = $image;
  }

  /**
   * @return int
   */
  public function getId() {
    return $this->id;
  }

  /**
   * @return string
   */
  public function getfullname() {
    return $this->fullname;
  }

  /**
   * @return string
   */
  public function getEmail() {
    return $this->email;
  }

  /**
   * @return string
   */
  public function getPassword() {
    return $this->password;
  }

  /**
   * @return string
   */
  public function getCountry() {
    return $this->country;
  }

  /**
   * @return string
   */
  public function getImage() {
    return $this->image;
  }

}