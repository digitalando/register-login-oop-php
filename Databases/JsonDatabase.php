<?php

namespace AFS\Databases;

/**
 * Clase de base de datos JSON
 *
 * @todo Agregar control de errores, por ejemplo cuando el archivo no puede escribirse.
 */
class JsonDatabase implements Database
{
    const JSON_DIR = __DIR__ . '/../data/json/';

    /**
     * @var string Nombre del archivo JSON
     */
    private $file;

    /**
     * @var string
     */
    private $table;

    /**
     * @var string
     */
    private $primaryKey = 'id';

    /**
     * @var bolean
     */
    private $incrementing = true;

    /**
     * Inicializa la base en función del nombre de la tabla.
     *
     * Se asume que el nombre de la tabla será el mismo que el del archivo que la contiene
     *
     * @param string $table
     */
    public function __construct($table)
    {
        $this->table = $table;
        $this->file = $table . '.json';

        $this->connect();
    }

    /**
     * Se conecta a la tabla especificada.
     *
     * Se verifica si el archivo existe, si no existe se crea vacío.
     */
    public function connect() 
    {
        if (!file_exists(self::JSON_DIR . $this->file)) 
        {
            $this->write();
        }
    }

    /** 
     * Trae todos los registros de una tabla.
     * 
     * @return array
     */
    public function fetchAll() :array 
    {
        $rawData = file_get_contents(self::JSON_DIR . $this->file);

        $rawData = json_decode($rawData, true);

        $rows = $rawData[$this->table];

        return $rows;
    }

    /**
     * Inserta un registro en la tabla.
     *
     * @param array $data
     */
    public function insert(array $row) 
    {
        $rows = $this->fetchAll();
        $rows[] = $row;
        
        $this->write($rows);
    }

    /**
     * Escribe los cambios en el archivo JSON.
     *
     * Este método sobrescribe el contenido existente en el archivo JSON.
     */
    private function write(array $rows = []) {
        $content = [
            $this->table => $rows
        ];

        file_put_contents(self::JSON_DIR . $this->file, json_encode($content));
    }

    public function autoincrement() 
    {
        $nextId = 1;
        
        $rows = $this->fetchAll();

        if (count($rows))
        {
            $lastRow = array_pop($rows);
            $nextId = $lastRow[$this->primaryKey] + 1;
        }
        
        return $nextId;
    }
}
    