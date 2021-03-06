<?php

namespace AFS\Forms;

/**
 * User Register Form
 *
 * Provee los métodos de validación para el formulario de login de usuarios.
 */
class UserLoginForm extends Form
{
    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var boolean
     */
    private $rememberMe;


    /**
     * Constructor del formulario de login.
     * 
     * @param array $post  Array de $_POST
     */
    public function __construct($post)
    {
        // Si el post llega vacío dejamos los campos vacíos
        $this->email = isset ($post['email']) ? $post['email'] : '';
        $this->password = isset ($post['password']) ? $post['password'] : '';
        $this->rememberMe = isset ($post['rememberMe']) ? true : false ;
    }

    /**
     * Valida el formulario de registro
     * @return boolean Verdadero en caso de que no haya errores, falso de lo contrario
     */
    public function isValid()
    {
        if (empty($this->email) )
        {
                $this->addError('email', 'Escribí tu correo electrónico');
        } else if ( !filter_var($this->email, FILTER_VALIDATE_EMAIL) )
        {
                $this->addError('email', 'Escribí un correo válido');
        }

        if (empty($this->password))
        {
                $this->addError('password', 'La contraseña no puede estar vacía');
        }

        return empty($this->getAllErrors());
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getRememberMe()
    {
        return $this->rememberMe;
    }

}