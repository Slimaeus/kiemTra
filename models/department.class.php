<?php
require_once("./config/db.class.php");

class Department
{
    public static function getAllDepartment()
    {
        $db = new Db();
        $queryString = "SELECT * FROM phong";
        return $db->select_to_array($queryString);
    }
}
