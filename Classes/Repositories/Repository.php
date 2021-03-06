<?php

namespace AFS\Repositories;

use AFS\Databases\JsonDatabase;

/**
* Clase abstracta de repositorios.
*
* Provee los métodos genéricos de conversión entre la base de datos y las entidades.
*/
abstract class Repository {
    /**
     * @var Database
     */
    protected $database;

    /**
     * @var string
     */
    protected $table;

    /**
     * Constructor de la clase.
     *
     * El constructor utilizará el tipo de base de datos especificada en el archivo de configuración.
     *
     * @param sting $table Nombre de la tabla
     */
    
    public function __construct()
    {
        $this->database = new JsonDatabase($this->table);
        $this->database->connect();
    }

    /**
     * Convierte una registro de la base de datos a una entidad. Método abstracto.
     *
     * @param array $row
     */
    protected abstract function rowToEntity(array $row);

    /**
     * Convierte un array registros de la base de datos a un array de entidades.
     *
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
