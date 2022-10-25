<?php
session_start();
$bdd = new PDO('mysql:dbname=lbc;host=localhost:3307', 'root', '');
if(!$_SESSION['nom']){
    header('Location: connexionTemp.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tous les utilisateurs</title>
</head>
<body>
    <?php
    $recupUser= $bdd->query('SELECT * FROM user');
    while($user = $recupUser->fetch()){ // on récupere tous les utilisateurs
        ?>
        <a href="message.php?idu=<?= $user['idu'] ?>">
            <?php echo $user['nom'];?>
        </a>
        <br>
        <?php

    }

    ?>


    
    <a href="deconnexion.php">
        <button>Se déconnecter</button>

    </a>
    
</body>
</html>