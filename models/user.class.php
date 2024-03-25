<?php
require_once('./config/db.class.php');

class User
{

    public static function getUserByUsername($username)
    {
        $db = new Db;
        $statement = $db->connect()->prepare("SELECT * FROM nguoidung WHERE Ten_ND = ?");
        $statement->bind_param("s", $username);
        $statement->execute();
        $result = $statement->get_result();
        $statement->close();
        return $result;
    }
}
