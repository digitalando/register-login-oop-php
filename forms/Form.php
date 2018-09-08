<?php

abstract class Form {
    private $messages;

    public function __construct() {
      $this->messages = [];
    }

    public abstract function isValid();

    public function getAllMessages() {
      return $this->messages;
    }

    public function addMessage($field, $message) {
      $this->messages[$field] = $message;
    }
}
