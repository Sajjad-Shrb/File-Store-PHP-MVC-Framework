<?php

namespace app\core;

class Database
{
    /**
     * Database host
     * @var string
     */
    const DB_Type = 'mysql';

    /**
     * Database host
     * @var string
     */
    const DB_HOST = '127.0.0.1';

    /**
     * Database name
     * @var string
     */
    const DB_NAME = 'File-Store';

    /**
     * Database user
     * @var string
     */
    const DB_USER = 'root';

    /**
     * Database password
     * @var string
     */
    const DB_PASSWORD = '2@0Z19Zm38s0';

    /**
     * Database host
     * @var string
     */
    const DB_CHARSET = 'utf8';
    
    public \PDO $pdo;

    public function __construct()
    {
        $dsn = sprintf("mysql:host=%s;dbname=%s;charset=UTF8", self::DB_HOST, self::DB_NAME);
    
        $this->pdo = new \PDO($dsn, self::DB_USER, self::DB_PASSWORD);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
}