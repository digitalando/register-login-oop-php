<?php

namespace AFS\Repositories;

use AFS\Config;

/**
 * Repositiorio de archivos
 *
 * Provee utilizades para el manejo de archivos
 */
class File 
{
	/**
	 * @var string Nombre original del archivo
	 */
	private $originalName;

	/**
	 * @var string Nombre temporal en el servidor
	 */
	private $temporalName;

	/**
	 * @var string Nombre temporal en el servidor
	 */
	private $finalName;

	/**
	 * @var string Extension del archivo
	 */
	private $extension;

	/**
	 * @var string Prefijo del archivo usado para generar el nombre
	 */
	private $prefix;

	/**
	 * @var string Prefijo del archivo usado para generar el nombre
	 */
	private $directory;


	/**
	 * Metodo constructor
	 *
	 * @todo $prefix y $directory deberian cambiar segun el tipo de archivo.
	 */
	public function __construct($file) {
		$this->prefix = 'user_img_';
		$this->directory = dirname(__FILE__) . "/../data/avatars/";

		$this->originalName = $file['name'];
		$this->temporalName = $file['tmp_name'];
		$this->extension = pathinfo($this->originalName, PATHINFO_EXTENSION);
		$this->generateRandomName();
	}

	/**
	 * Genera un nombre de archivo aleatorio
	 */
	public function generateRandomName()
	{
		$this->finalName = uniqid($this->prefix) .  '.' . $this->extension;
	}

	/**
	 * Guarda la imagen en el directorio final
	 */
	public function save() 
	{
		$finalPath = $this->directory . $this->finalName;

		move_uploaded_file($this->originalName, $finalPath);
	}

	/**
	 * @return string
	 */	
	public function getFinalName()
	{
		return $this->finalName;
	}

	/**
	 * @return string
	 */
	public function getExtension()
	{
		return $this->extension;
	}


}