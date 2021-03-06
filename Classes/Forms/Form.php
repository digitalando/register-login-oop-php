<?php

namespace AFS\Forms;

/**
 * Clase abstracta de formularios.
 *
 * Provee los métodos de validación para todas las clases que extiendan de ésta.
 */
abstract class Form {
    /**
     * @var array $errors
     */
    private $errors;

    public function __construct() {
      $this->errors = [];
    }

    public abstract function isValid();

    /**
     * Retorna un array con los errores del formulario.
     *
     * @return array
     */
    public function getAllerrors() {
      return $this->errors;
    }

    /**
     * Retorna verdadero si el campo tiene error, falso de lo contrario.
     *
     * @param string $field
     *
     * @return boolean
     */
    public function fieldHasError($field) {
      return isset($this->errors[$field]);
    }

    /**
     * Retorna el error si el campo tiene error, falso de lo contrario.
     *
     * @param string $field
     *
     * @return array|false
     */
    public function getFieldError($field) {
      return $this->errors[$field] ?? false;
    }

    /**
     * Agrega un error al array de errores.
     *
     * @param string $field
     * @param string $error
     *
     * @return array
     */
    public function addError($field, $error) {
      $this->errors[$field] = $error;
    }
}
