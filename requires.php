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

use AFS\Repositories\Form;
use AFS\Repositories\UserRegisterForm;

/* Entities */
require_once "Entities/User.php";

use AFS\Entities\User;

/* Repositories */
require_once "Repositories/Repository.php";
require_once "Repositories/UserRepository.php";

use AFS\Repositories\Repository;
use AFS\Repositories\UserRepository;
