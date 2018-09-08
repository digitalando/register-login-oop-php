<?php

class UserRegisterForm extends Form {

  /* @var string */
  private $fullName;

  /* @var string */
  private $email;

  /* @var string */
  private $password;

  /* @var string */
  private $passwordConfirm;

  /* @var string */
  private $country;

  /* @var string */
  private $image;

  public function __construct($post, $files) {
    // Si el post llega vacío dejamos los campos vacíos
    $this->fullName = isset ($post['userFullName']) ? $post['userFullName'] : '';
    $this->email = isset ($post['userEmail']) ? $post['userEmail'] : '';
    $this->password = isset ($post['userPassword']) ? $post['userPassword'] : '';
    $this->passwordConfirm = isset ($post['userRePassword']) ? $post['userRePassword'] : '';
    $this->country = isset ($post['userCountry']) ? $post['userCountry'] : '';
    $this->image = isset ($files['userAvatar']) ? $files['userAvatar'] : '';
  }

  public function isValid() {
    if ( empty($this->fullName) ) {
      $this->addMessage('fullName', 'Escribí tu nombre completo');
    }

    if ( empty($this->email) ) {
      $this->addMessage('email', 'Escribí tu correo electrónico');
    } else if ( !filter_var($this->email, FILTER_VALIDATE_EMAIL) ) {
      $this->addMessage('email', 'Escribí un correo válido');
    } //else if ( emailExist($email) ) {
      //$this->addMessage('email', 'Ese email ya fue registrado');
    //}

    if ( empty($this->password) || empty($this->passwordConfirm) ) {
      $this->addMessage('password', 'La contraseña no puede estar vacía');
    } elseif ( $this->password != $this->passwordConfirm) {
      $this->addMessage('password', 'Las contraseñas no coinciden');
    } elseif ( strlen($this->password) < 4 || strlen($this->passwordConfirm) < 4 ) {
      $this->addMessage('password', 'La contraseña debe tener más de 4 caracteres');
    }

    if ( empty($this->country) ) {
      $this->addMessage('country', 'Elegí un país');
    }

    if ( $this->image['error'] !== UPLOAD_ERR_OK ) {
      $this->addMessage('image', 'Ché subite una imagen');
    } else {
      $ext = pathinfo($this->image['name'], PATHINFO_EXTENSION);
      if ( !in_array($ext, ALLOWED_IMAGE_TYPES) ) {
        $this->addMessage('image', 'Formato de imagen no permitido');
      }
    }

    return empty($this->getAllMessages());
  }

  public function getFullName() {
    return $this->fullName;
  }

  public function getEmail() {
    return $this->email;
  }

  public function getPassword() {
    return $this->password;
  }

  public function getCountry() {
    return $this->country;
  }

  public function getImage() {
    return $this->image;
  }

}
