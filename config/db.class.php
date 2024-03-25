<?php
class Db
{
    protected static $connection;

    public function connect()
    {
        if (!isset(self::$connection)) {
            $config = parse_ini_file("config.ini");
            self::$connection = new mysqli("localhost", $config["username"], $config["password"], $config["databasename"]);

            if (self::$connection->connect_error) {
                die("Connection failed: " . self::$connection->connect_error);
            }
        }

        return self::$connection;
    }

    public function query_execute($queryString)
    {
        $connection = $this->connect();

        $result = $connection->query($queryString);

        if (!$result) {
            echo "Error executing query: " . $connection->error;
        }

        return $result;
    }

    public function select_to_array($queryString)
    {
        $rows = array();
        $result = $this->query_execute($queryString);

        if ($result === false) return false;

        while ($item = $result->fetch_assoc()) {
            $rows[] = $item;
        }

        return $rows;
    }

    public function query_count($queryString) {
      self::connect();
      return self::$connection->query($queryString)->fetch_row()[0];
    }

    public static function close_connection()
    {
        if (isset(self::$connection)) {
            self::$connection->close();
        }
    }
}
