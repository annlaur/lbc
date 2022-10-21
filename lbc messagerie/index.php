<?php
session_start();
$bdd = new PDO('mysql:dbname=messages_prives;host=localhost', 'root', '');
if(!$_SESSION['pseudo']){
    header('Location: connexion.php');
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
    $recupUser= $bdd->query('SELECT * FROM users');
    while($user = $recupUser->fetch()){ // on récupere tous les utilisateurs
        ?>
        <a href="message.php?id=<?php echo $user['id']; ?>">
            <p><?php echo $user['pseudo'];?></p>
        </a>
        <?php

    }

    ?>


    
    <a href="deconnexion.php">
        <button>Se déconnecter</button>

    </a>
    
</body>
</html>