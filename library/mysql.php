<?php
/**
 *
 */
class Mysql implements Database {
    //protected $connection;
    //private $host;
    //private $user;
    //private $password;
    //private $db;
    public $_table;
    //private $_pk;

    public function __construct() {
        $this->host = HOST;
        $this->user = USERNAME;
        $this->password = PASSWORD;
        $this->db = DB;
        $this->connection = self::connect();
        mysqli_report(MYSQLI_REPORT_STRICT);
    }
    public function connect() {
        // Define connection as a static variable, to avoid connecting more than once
        static $connection;
        // Try and connect to the database, if a connection has not been established yet
        if (!isset($connection)) {
            // Load configuration as an array. Use the actual location of your configuration file
            $connection = mysqli_connect($this->host, $this->user, $this->password, $this->db);
        }
        // If connection was not successful, handle the error
        if ($connection === false) {
            // Handle error - notify administrator, log to a file, show an error screen, etc.
            logs(mysqli_connect_error());
            return mysqli_connect_error();
        }
        return $connection;
    }
    /**
     * Set Table and Default Key
     */
    public function setTable($table, $pk = 'id') {
        $this->_table = $table;
        $this->_pk = $pk;
    }
    public function getData($id) {
        return $this->getById($id, $this->_table, $this->_pk, $options = null);
    }
    public function getDatas($kriteria, callable $callable) {
        var_dump($callable);
        $tmpwhere = "";
        if (!empty($kriteria)) {
            foreach ($kriteria as $key => $value) {
                $value = gettype($value) == 'integer' ? $value : '"' . $value . '"';
                $tmpwhere .= ' ' . $key . '=' . $value;
            }
            $where = "WHERE $tmpwhere";
        }
        return $this->Exec("SELECT * FROM $this->_table $where");
    }

    public function Exec($sql, $action = null, $mode = null) {
        $data = [];
        if (!$mode) {
            logs('SQL:' . $sql);
        }

        $result = mysqli_query($this->connection, $sql);
        if (!$result) {
            $result = new stdClass;
            $result->error = $this->connection->error;
            $result->errno = $this->connection->errno;
            logs($this->connection->errno . ':' . $this->connection->error);
            // var_dump($result);
            return $result;
        }
        if (is_object($result)) {
            if (isset($action) == 'length') {
                return mysqli_num_rows($result);
            }
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = (Object) $row;
            }
            return $data;
            mysqli_free_result($result);
        }
        // return $result;
    }

    /**********************************************************
     * Insert data into table:
     *   table  : current working table
     *   inputs : array of datas (and its fields)
     *      Ex:
     *        [ 'name' => 'jhon doe', 'age' => 31 ]
     *   type   : array of type of fields (optional)
     *      Ex:
     *        [ 'name' => 'char', 'age' => int ]
     *
     ********************************************************** */
    public function create($inputs, $option = null) {
        $fields = '';
        $data = '';
        $arrkeys = [];
        $arrvalues = [];
        $i = 0;
        foreach ($inputs as $key => $value) {
            $arrkeys[] = $key;
            logs('Data:' . $key . '=' . gettype($value));
            $value = gettype($value) == 'string' ? "'$value'" : $value;
            $value = $value ? $value : 'NULL';
            $arrvalue[] = $value;
        }
        $fields = join($arrkeys, ',');
        $data = join($arrvalue, ',');
        $sql = "INSERT INTO $this->_table ";
        $sql .= "($fields) ";
        $sql .= "VALUE($data)";
        if ($option) {
            switch ($option) {
            case 'update':
                $sql .= " ON DUPLICATE KEY UPDATE ";
                $arrvalue = [];
                foreach ($inputs as $key => $value) {
                    $value = gettype($value) == 'string' ? "'$value'" : $value;
                    $value = $value ? $value : 'NULL';
                    $arrvalue[] = $key . '=' . $value;
                }
                $sql .= join($arrvalue, ',');
                break;

            default:
                # code...
                break;
            }
        }
        logs($sql);
        $result = $this->Exec($sql);
        return $result;
    }
    /**********************************************************
     * Update certain data in table:
     *   id    : identifier or key of data
     *   table  : current working table
     *   inputs : array of datas (and its fields)
     *      Ex:
     *        [ 'name' => 'jhon doe', 'age' => 31 ]
     *   type   : array of type of fields (optional)
     *      Ex:
     *        [ 'name' => 'char', 'age' => int ]
     *
     ********************************************************** */
    public function update($inputs, $id, $pk = 'id', $option = null) {
        $fields = '';
        $data = '';
        $pkdata;
        $arrkeys = [];
        $arrvalues = [];
        $i = 0;
        foreach ($inputs as $key => $value) {
            if ($key == $pk) {
                continue;
            }

            logs('Data:' . $key . '=' . gettype($value));
            $value = gettype($value) == 'string' ? "'$value'" : $value;
            $value = $value ? $value : 'NULL';
            $arrdata[] = "$key = $value";
        }
        $data = join($arrdata, ',');
        $sql = "UPDATE $this->_table SET ";
        $sql .= "$data ";
        $sql .= gettype($id) == 'string' ? "WHERE $pk = '$id'" : "WHERE $pk = $id";
        logs($sql);
        $result = $this->Exec($sql);
        return $result;
    }

}
