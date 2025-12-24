<?php

class DataBase{
    private $host;
    private $db;
    private $username;
    private $pwd;
    private $charset;

    public function connexion(){
      $host=  $this->host = "localhost";
       $db = $this->db="coach_pro_V2";
       $username = $this->username="root";
       $pwd= $this->pwd="";
      $charset=  $this->charset="utf8";
        try{
        $dsn="mysql:host=$host;dbname=$db;charset=$charset";
        $pdo= new PDO($dsn,$username,$pwd);
        
        return $pdo;
    }catch(PDOException $e){
        echo "Connection failed ".$e->getMessage();

    }

    }

    

}


?>

