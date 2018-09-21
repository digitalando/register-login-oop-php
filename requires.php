<?php
/**
 * Archivo de requires
 *
 * En este archivo deben agregarse las dependencias del proyecto.
 *
 * @todo En el futuro implementar autoloading de clases. Ver: http://php.net/manual/es/language.oop5.autoload.php.
 */

/* Config */
require_once "config.php";

/* Forms */
require_once "Forms/Form.php";
require_once "Forms/UserRegisterForm.php";

/* Entities */
require_once "Entities/User.php";

/* Databases */
require_once "Databases/Database.php";
require_once "Databases/JsonDatabase.php";

/* Repositories */
require_once "Repositories/File.php";
require_once "Repositories/Repository.php";
require_once "Repositories/UserRepository.php";
