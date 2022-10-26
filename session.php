<!-- fichier inclut partout avec variable de session et session start -->
<?php
    //$pdo = new PDO('mysql:host=localhost;dbname=lbc', 'root', '');
    $pdo = new PDO('mysql:host=localhost:3307;dbname=lbc', 'root', '');
    $pdo->exec("SET NAMES utf8");
    session_start();
    if(isset($_SESSION["nom"])){
    
    $mail=$_SESSION["mail"];
    $nom=$_SESSION["nom"];
    $idu=$_SESSION["idu"];
    
    
    }else{
        header("location:connexionTemp.php");
    }
?>