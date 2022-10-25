<?php
require_once('header.html');
$bdd = new PDO('mysql:host=localhost;dbname=lbc', 'root', '');
$req = $bdd -> query(('SELECT * FROM annonce'));
if(isset($_GET['s']) AND !empty($_GET['s']))
{
    $recherche = htmlspecialchars($_GET['s']);
    $req = $bdd -> query('SELECT titre FROM annonce WHERE titre LIKE"% '.$recherche.'%"');
}


?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="GET">
        <input type="search" name="s" placeholder="Que recherchez-vous?">
        <input type="submit" name="envoyer">
</form>
<section>
    <?php
    if($req -> rowCount() > 0){
        while($use = $req->fetch()){
            ?>
            <p><?=$use['titre']; ?></p>
            <?php 
        }
    }else{ 
        ?>
    <p>
Aucune annonce trouvée 
    </p>
    <?php

    }
    ?>
</section>
</body>
</html>