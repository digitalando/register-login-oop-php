<?php

namespace AFS\Repositories;

use AFS\Repositories\File;

/**
 * Clase de imagenes de usuarios
 */
class UserImageFile extends File
{
	/**
	 * @var string Prefijo del archivo usado para generar el nombre
	 */
	protected $prefix = 'user_img_';

	/**
	 * @var string Prefijo del archivo usado para generar el nombre
	 */
	protected $directory = __DIR__ . "/../../data/avatars/";
}