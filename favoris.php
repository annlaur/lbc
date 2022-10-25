<?php 
require_once("session.php");
require_once("fonction.php");
require_once("test.php");
require_once("header.php");

    $ida = $_GET['ida'];
    foreach($pdo->query("select count(*) from favoris where ida='$ida' and idu='$idu'",PDO::FETCH_ASSOC) as $compte_fav){

        $nbFav = $compte_fav['count(*)']; // on compte les lignes 

        if($nbFav == 0){ //si le favoris n'existe pas deja on ajoute dans la table favoris
            $query =$pdo->prepare("insert into favoris(ida, idu) values('$ida','$idu')");
            $query->execute();
            header("location:prcp_annonce.php");
           

        }else{ //si il existe on le retire de la table favoris 
            $query =$pdo->prepare("delete from favoris where favoris.ida = '$ida' and favoris.idu = '$idu'");
            $query->execute();
            header("location:prcp_annonce.php");
        }
    }


    
?>