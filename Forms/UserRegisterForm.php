<?php

namespace AFS\Forms;

/**
 * User Register Form
 *
 * This class provides validation methods for the user register form
 */
class UserRegisterForm extends Form {

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
    $this->fullName = isset ($post['userFullName']) ? $post['userFullName'] : '';
    $this->email = isset ($post['userEmail']) ? $post['userEmail'] : '';
    $this->password = isset ($post['userPassword']) ? $post['userPassword'] : '';
    $this->passwordConfirm = isset ($post['userRePassword']) ? $post['userRePassword'] : '';
    $this->country = isset ($post['userCountry']) ? $post['userCountry'] : '';
    $this->image = isset ($files['userAvatar']) ? $files['userAvatar'] : [];
  }

  public function isValid() {
    if ( empty($this->fullName) ) {
      $this->addError('fullName', 'Escribí tu nombre completo');
    }

    if ( empty($this->email) ) {
      $this->addError('email', 'Escribí tu correo electrónico');
    } else if ( !filter_var($this->email, FILTER_VALIDATE_EMAIL) ) {
      $this->addError('email', 'Escribí un correo válido');
    } //else if ( emailExist($email) ) {
      //$this->addError('email', 'Ese email ya fue registrado');
    //}

    if ( empty($this->password) || empty($this->passwordConfirm) ) {
      $this->addError('password', 'La contraseña no puede estar vacía');
    } elseif ( $this->password != $this->passwordConfirm) {
      $this->addError('password', 'Las contraseñas no coinciden');
    } elseif ( strlen($this->password) < 4 || strlen($this->passwordConfirm) < 4 ) {
      $this->addError('password', 'La contraseña debe tener más de 4 caracteres');
    }

    if ( empty($this->country) ) {
      $this->addError('country', 'Elegí un país');
    }

    if ( $this->image) {
      if ( $this->image['error'] !== UPLOAD_ERR_OK ) {
        $this->addError('image', 'Ché subite una imagen');
      } else {
        $ext = pathinfo($this->image['name'], PATHINFO_EXTENSION);
        if ( !in_array($ext, ALLOWED_IMAGE_TYPES) ) {
          $this->addError('image', 'Formato de imagen no permitido');
        }
      }
    }

    return empty($this->getAllErrors());
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