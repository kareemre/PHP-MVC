<?php 

namespace Matariya\Database;

class MySqlQueryBuilder
{    
    
    /**
     * connection instance 
     *
     * @var \PDO
     */
    private $connection;
    /**
     * table name
     *
     * @var string
     */
    private $table;
    
    /**
     * user's data that will be handled through the application    
     *
     * @var array
     */
    private $data = [];
    
    /**
     * container used for where statements
     *
     * @var array
     */
    private $wheres = [];

        /**
     * user's bindings container   
     *
     * @var array
     */
    private $bindings = [];
    
    
    public function __construct(MySqlConnection $connection)
     {
        $this->connection = $connection;
     }


        /**
     * set the table name
     *
     * @param  string $table
     * @return $this
     */
    public function table($table)
    {
        $this->table = $table;

        return $this;
    }

    
    /**
     * from statement
     *
     * @param  mixed $table
     * @return $this
     */
    public function from($table)
    {
       return $this->table($table);
    }

        
    /**
     * sql WHERE clause
     *
     * @param  mixed $params
     * @return object
     */
    public function where(...$params)
    {
        $sql = array_shift($params);

        $this->addToBindings($params);

        $this->wheres[] = $sql;

        return $this;
    }

    
    /**
     * merge user data if array to data container
     *
     * @param  mixed $key
     * @param  mixed $value
     * @return $this
     */
    public function data($key, $value = null)
    {
        if (is_array($key)) {
            $this->data = array_merge($this->data, $key);

            $this->addToBindings($key);
        } else {
            $this->data[$key] = $value;

            $this->addToBindings($value);
        }

        return $this;
    }


    /**
     * Insert to database table
     * 
     * @param array $data
     * @return object
     */
    public  function insert($table = null)
    {
        if ($table) {
            $this->table($table);
        } 
        $sqlQuery = "INSERT INTO " . $this->table . " SET ";

        $sqlQuery = $this->setFields();

        $this->queryExcute($sqlQuery, $this->bindings);
        return $this;     
    }

    
    /**
     * update database record
     *
     * @param  mixed $table
     * @return object
     */
    public function update($table)
    {
        if ($table) {
            $this->table($table);
        } 
        $sqlQuery = "UPDATE " . $this->table . " SET ";

        $sqlQuery .= $this->setFields();
        
        if ($this->wheres) {
            $sqlQuery .= ' WHERE ' . implode(' ' , $this->wheres);
        }

        $this->queryExcute($sqlQuery, $this->bindings);
        return $this;
    }

    /**
     * Set the fields for insert and update
     *
     * @return string
     */
      private function setFields()
      {
          $sql = '';
 
          foreach (array_keys($this->data) as $key) {
              $sql .= '`' . $key . '` = ? , ';
          }
 
          $sql = rtrim($sql, ', ');
 
          return $sql;
      }


    /**
     * adding values to bindings array
     *
     * @param  mixed $value
     * @return void
     */
    private function addToBindings(string|array $value)
    {
        if (is_array($value)) {
            $this->bindings = array_merge($this->bindings, array_values($value));
        } else {
            $this->bindings[] = $value;
        }
    }

    
    /**
     * executing a sql query
     *
     * @param  mixed $params
     * @return \PDOStatement
     */
    private function queryExcute(...$params)
    {
        $sqlQuery = array_shift($params);

         if (count($params) == 1 AND is_array($params[0])) {
             $params = $params[0];
         }

         try {
             $query = $this->connection->getConnection()->prepare($sqlQuery);

             foreach ($params as $key => $value) {
                 $query->bindValue($key + 1, htmlspecialchars($value));
             }

             $query->execute();

             return $query;

         } catch (\PDOException $e) {
            
             echo $sqlQuery;
             echo '<pre>';
             print_r($this->bindings);
             echo '</pre>';
             die($e->getMessage());
         }
    }
}