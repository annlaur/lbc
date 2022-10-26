<?php
    require("session.php");
    require("fonction.php");
    require("test.php");

    $ida = $_GET['ida'];
    
    $annonce = getUneAnnonce($pdo, $ida);
    $req = "delete from annonce where annonce.ida = '$ida'";
    $statement = $pdo->prepare($req);
    $statement->execute();
    echo "<span class='text-center'>votre annonce a bien été supprimée</span>";
    header("refresh:2;url=profil.php");
    
?>