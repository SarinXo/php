<?php

#[AllowDynamicProperties] class Database
{
    private static PDO $connection;

    public function __construct(){
        $host = "mysql";
        $port = "9907";
        $dbname = "firsova";
        $charset = "utf8";
        $dbuser = "root";
        $dbpass = "root";

        try{
            self::$connection = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset", $dbuser, $dbpass);
        }catch(PDOException $e){
            echo $e->getMessage();
            exit;
        }
    }

    private function getAllEntities()
    {
        return $this->doQuery('SELECT * FROM `books`');
    }

    private function doQuery($sql){
        $query = self::$connection->prepare($sql);
        $query ->execute();
        return $query;
    }

    public function htmlAllBooks(){
        $result = $this->getAllEntities();
        $number = 1;
        while ($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            echo '<p><strong>'.$number.' Название:';
            echo  stripslashes($row['title']);

            echo '</strong><br/>Автор: ';
            echo stripslashes($row['author']);

            echo '<br/>ISBN: ';
            echo stripslashes($row['isbn']);

            echo '<br/>Цена: ';
            echo stripslashes($row['price']);
            echo '</p>';
            $number++;
        }
    }


    function delete_pull(): void
    {
        self::$connection = null;
    }

}










