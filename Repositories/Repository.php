<?php

namespace AFS\Repositories;

/**
 *
 */
abstract class Repository {
	/**
   * @var string
   */
	private $table;

	public function __construct(string $table, DB $driver)
	{
		$this->table = $table;
		$driver->connect($this->table);
	}

  /**
   * @param array $row
   */
  protected abstract function rowToEntity(array $row);

	/**
   * @param array $rows
   *
   * @return array
   */
  protected function rowsToEntities(array $rows): array
  {
      $entities = [];
      foreach($rows as $row)
      {
          $entities[] = $this->rowToEntity($row);
      }

      return $entities;
  }
}
