<?php 
namespace Matariya\Database;
use PDO;
use PDOException;

class connection
{ 
     /**
     * PDO connection 
     *
     * @var \PDO
     */
    private static $connection;

    public function __construct()
    {
        if (! $this->isConnected()) {
            $this->connect();
        }
    }

    
    /**
     * determine and ensuring it's a single connection
     *
     * @return bool
     */
    private function isConnected()
    {
        return static::$connection instanceof PDO;
    }
    
    /**
     * connect to the database server
     *
     * @return void
     */
    private function connect()
    {
        try {
            static::$connection = new PDO('mysql:host=localhost;dbname=auth', 'root', '');
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        
    }
    
    /**
     * get database Connection instance
     *
     * @return \PDO
     */
    public function getConnection()
    {
        return static::$connection;
    }

}