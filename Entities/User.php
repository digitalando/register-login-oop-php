<?php

namespace AFS\Entitites;

/**
 * User Entity
 *
 * This class provides the user entity
 */
class User {

  /**
   * @var string
   */
  private $fullName;

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
  private $passwordConfirm;

  /**
   * @var string
   */
  private $country;

  /**
   * @var string
   */
  private $image;

  public function __construct($post, $files) {
    // Si el post llega vacío dejamos los campos vacíos
    $this->fullName = $userFullName;
    $this->email = $userEmail;
    $this->password = $userPassword;
    $this->passwordConfirm = $userRePassword;
    $this->country = $userCountry;
    $this->image = $files['userAvatar'];
  }

 /**
  * @return string
  */
  public function getFullName() {
    return $this->fullName;
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
   * @return array
   */
  public function getImage() {
    return $this->image;
  }

}