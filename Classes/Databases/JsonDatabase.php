<?php

namespace AFS\Databases;

/**
 * Clase de base de datos JSON
 *
 * @todo Agregar control de errores, por ejemplo cuando el archivo no puede escribirse.
 */
class JsonDatabase implements Database
{
    /**
     * @todo Esto debería ser configurado desde el archivo de configuración.
     */
    const JSON_DIR = __DIR__ . '/../../data/json/';

    /**
     * @var string Nombre del archivo JSON
     */
    private $file;

    /**
     * @var string Nombre de la tabla
     */
    private $table;

    /**
     * @var string Nombre del campo que contiene la clave primaria
     */
    private $primaryKey = 'id';

    /**
     * @var boolean Indica si existe un campo autoincremental
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
    public function insert(array $data) 
    {
        $rows = $this->fetchAll();
        $rows[] = $data;
        
        $this->write($rows);
    }

    /**
     * Modifica un registro exitente en la tabla.
     *
     * El método solo modificará los registros en función de la llave primaria.
     *
     * @param array $data
     */
    public function update(array $data) 
    {
        $rows = $this->fetchAll();

        foreach ($rows as $key => $row) {
            if ($row[$this->primaryKey] == $data[$this->primaryKey])
            {
                $rows[$key] = $data;
            }
        }
        
        $this->write($rows);
    }

    /**
     * Trae el primer registro que cumpla con la condición dada
     * 
     * @param  array $condition
     * @return array|false
     */
    public function fetch(array $condition) {
        $rows = $this->fetchAll();

        foreach ($rows as $row) {
            foreach ($condition as $field => $value) {
                if ($row[$field] == $value)
                {
                    return $row;
                }
            }
        }
        
        return false;
    }

    /**
     * Escribe los cambios en el archivo JSON.
     *
     * Este método sobrescribe el contenido existente en el archivo JSON. En caso de que el archivo no exista, lo creará.
     *
     * @param array $rows [<description>]
     */
    private function write(array $rows = []) {
        $content = [
            $this->table => $rows
        ];

        file_put_contents(self::JSON_DIR . $this->file, json_encode($content));
    }

    /**
     * Genera el próximo valor de la clave primaria
     * 
     * @return int
     */
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
    