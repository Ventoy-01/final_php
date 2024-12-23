<?php 
    $servername = "127.0.0.1";
    $username='root';
    $pwd="";
    $dbname="cafeteria_chcl";
    try {
       $pdo = new PDO("mysql:host=$servername;dbname=$dbname",$username,$pwd);
    } catch (PDOException $e) {
        echo "Erreur: ".$e->getMessage();
    }
?>