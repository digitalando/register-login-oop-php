<?php
/**
 * Archivo de requires
 *
 * En este archivo deben agregarse las dependencias del proyecto.
 *
 * @todo En el futuro implementar autoloading de clases. Ver: http://php.net/manual/es/language.oop5.autoload.php.
 */

/* Forms */
require_once "Classes/Forms/Form.php";
require_once "Classes/Forms/UserLoginForm.php";
require_once "Classes/Forms/UserRegisterForm.php";

/* Entities */
require_once "Classes/Entities/Auth.php";
require_once "Classes/Entities/User.php";

/* Databases */
require_once "Classes/Databases/Database.php";
require_once "Classes/Databases/JsonDatabase.php";

/* Repositories */
require_once "Classes/Repositories/File.php";
require_once "Classes/Repositories/UserImageFile.php";

require_once "Classes/Repositories/Repository.php";
require_once "Classes/Repositories/UserRepository.php";

use AFS\Entities\Auth;
$auth = new Auth();