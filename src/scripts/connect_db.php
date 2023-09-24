<?php

#[AllowDynamicProperties] class Database
{
    private static PDO $connection;

    public function __construct(){
        $host = 'mysql';
        $dbname = 'dns';
        $charset = 'utf8';
        $dbuser = 'root';
        $dbpass = 'root';

        try{
            self::$connection = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset", $dbuser, $dbpass);
        }catch(PDOException $e){
            echo $e->getMessage();
            exit;
        }
    }

    public function getAllEntities($table)
    {
        $query = self::$connection->prepare("SELECT * FROM :table");
        $query->bindValue(':table', '`' . $table . '`', PDO::PARAM_STR);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function delete_pull(): void
    {
        self::$connection = null;
    }

}










