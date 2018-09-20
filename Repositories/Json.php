<?php

namespace AFS\Repositories;

class Json implements Database
{
	const JSON_DIR = __DIR__ . '../data/json/';

	/**
   * @var string
   */
	private $table;

  /**
   * @var string
   */
	private $file;

	/**
	 * We asume the name of the file will allways be the same as the name.
	 * If it's not the case anymore, this code will need refactoting.
   *
   * @param string $table
	 */
	public function __construct($table)
	{
		$this->name = $table;
		$this->file = $table . '.json';

		$this->connect();
	}


	public function connect()
	{
		if (!file_exists(JSON_DIR . $this->file))
    {
        $this->write();
    }
	}

	/** @returns array */
	protected function fetchAll() :array
	{
		if (!file_exists(JSON_DIR . $this->file))
	    {
	        $this->write();
	    }

	    $entities = file_get_contents(JSON_DIR . $this->file);

	    $entities = json_decode($entities, true);

	    return $entities[$this->name];
	}

	/**
   * @param array $data
   */
	public function insert(array $data)
	{
	    $entities = $this->fetchAll();
	    $entities[] = $data;

	    $this->write($entities);
	}

	/**
	 * This function will overwrite any existing contents of the file
	 *
	 * @return void
	 */
	public function write(array $entities = [])
	{
	    $content = [
	        $this->name => $entities
	    ];

	    file_put_contents(JSON_DIR . $this->file, json_encode($content));
	}
}
