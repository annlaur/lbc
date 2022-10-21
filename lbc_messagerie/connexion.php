<?php
session_start();
$bdd = new PDO('mysql:dbname=messages_prives;host=localhost', 'root', '');
if(isset($_POST['valider'])){
    if(!empty($_POST['pseudo'])){

        $recupUser= $bdd-> prepare('SELECT * FROM users WHERE pseudo = ?');
        $recupUser->execute(array($_POST['pseudo']));

        if($recupUser->rowCount() > 0){ // si on récupère un nombre d'utilisateurs > 0

            $_SESSION['pseudo'] = $_POST['pseudo'];
            $_SESSION['id'] = $recupUser->fetch()['id'];   // On récupère toute les données de la requete recupUser (id)
            header('Location: index.php');
        }else{
            echo "Aucun utilisateur trouvé";
        }

    }else{
        echo "Veulliez rentrer votre pseudo";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace de connexion</title>

</head>
<body>
    <form action="" method="POST">
        <input type="text" name="pseudo" id="">
        <br>
        <input type="submit" name="valider">


    </form>
    
</body>
</html>