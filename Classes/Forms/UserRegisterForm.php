<?php

namespace AFS\Forms;

/**
 * User Register Form
 *
 * Provee los métodos de validación para el formulario de registro de usuarios.
 */
class UserRegisterForm extends Form
{
    const ALLOWED_IMAGE_TYPES = ['jpg', 'png', 'jpeg', 'gif', 'svg'];

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
    private $passwordConfirm;

    /**
     * @var string
     */
    private $country;

    /**
     * @var string
     */
    private $image;

    /**
     * Constructor del formulario de registro.
     * 
     * @param array $post  Array de $_POST
     * @param array $files Array de $_FILES
     */
    public function __construct($post, $files)
    {
        // Si el post llega vacío dejamos los campos vacíos
        $this->fullname = isset ($post['fullname']) ? $post['fullname'] : '';
        $this->email = isset ($post['email']) ? $post['email'] : '';
        $this->password = isset ($post['password']) ? $post['password'] : '';
        $this->passwordConfirm = isset ($post['rePassword']) ? $post['rePassword'] : '';
        $this->country = isset ($post['country']) ? $post['country'] : '';
        $this->image = isset ($files['avatar']) ? $files['avatar'] : [];
    }

    /**
     * Retorna el estado de validación del formulario. 
     * 
     * @return boolean
     */
    public function isValid()
    {
        if (empty($this->fullname) )
        {
                $this->addError('fullname', 'Escribí tu nombre completo');
        }

        if (empty($this->email) )
        {
                $this->addError('email', 'Escribí tu correo electrónico');
        } 
        else if ( !filter_var($this->email, FILTER_VALIDATE_EMAIL) )
        {
                $this->addError('email', 'Escribí un correo válido');
        }

        if (empty($this->password) || empty($this->passwordConfirm) )
        {
                $this->addError('password', 'La contraseña no puede estar vacía');
        } 
        elseif ( $this->password != $this->passwordConfirm)
        {
                $this->addError('password', 'Las contraseñas no coinciden');
        } 
        elseif ( strlen($this->password) < 4 || strlen($this->passwordConfirm) < 4 )
        {
                $this->addError('password', 'La contraseña debe tener más de 4 caracteres');
        }

        if ( empty($this->country) )
        {
                $this->addError('country', 'Elegí un país');
        }

        if ($this->image)
        {
            if ( $this->image['error'] !== UPLOAD_ERR_OK )
            {
                $this->addError('image', 'Ché subite una imagen');
            } 
            else
            {
                $ext = pathinfo($this->image['name'], PATHINFO_EXTENSION);
                if ( !in_array($ext, self::ALLOWED_IMAGE_TYPES) )
                {
                    $this->addError('image', 'Formato de imagen no permitido');
                }
            }
        }

        return empty($this->getAllErrors());
    }

    /**
     * @return string
     */
    public function getFullname()
    {
        return $this->fullname;
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
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return array
     */
    public function getImage()
    {
        return $this->image;
    }

}