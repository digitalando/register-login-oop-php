<?php

namespace AFS\Forms;

/**
 * Abstract form class
 *
 * This class provides shared methods for all forms that will extend it
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
     * Returns form errors or an empty array otherwise
     *
     * @return array
     */
    public function getAllerrors() {
      return $this->errors;
    }

    /**
     * Returns true if field has errors, false otherwise
     *
     * @param string $field
     *
     * @return boolean
     */
    public function fieldHasError($field) {
      return isset($this->errors[$field]);
    }

    /**
     * Returns the field error if it has one, false otherwise
     *
     * @param string $field
     *
     * @return array|false
     */
    public function getFieldError($field) {
      return $this->errors[$field] ?? false;
    }

    /**
     * Adds an error to the error array
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
