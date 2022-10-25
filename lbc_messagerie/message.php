<?php
session_start();
$bdd = new PDO('mysql:dbname=lbc;host=localhost:3307', 'root', '');
if(!$_SESSION['pseudo']){
    header('Location: connexion.php');
}
if(isset($_GET['id']) AND !empty($_GET['id'])){

    $getid=$_GET['idu'];
    $recupUser=$bdd->prepare('SELECT * FROM user WHERE idu = ?');  // on verifie si l'id est bien dans la bdd
    $recupUser->execute(array($_GET['idm']));
    if($recupUser->rowCount() > 0){ // si on trouve bien un utilisateur
        if(isset($_POST['envoyer'])){
            $message = htmlspecialchars($_POST['message']); // evite que l'utilisateur utilise du html
            $insererMessage= $bdd->prepare('INSERT INTO message(message,id_destinataire,id_auteur,date)VALUES(?,?,?,NOW())');
            $insererMessage->execute(array($message,$_GET['idm'],$_SESSION['idm']));
        }
    }else{
        echo "Aucun utilisateur trouvé";
    }

    
    


}else{
    echo "Aucun identifiant trouvé";
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message privé</title>
</head>
<body>
    <form action="" method="POST">

        <textarea name="message" id="" cols="30" rows="10"></textarea>
        <br><br>
        <input type="submit" name="envoyer">
    </form>

    <section id="messages">

    <?php
        
        $recupMessages= $bdd->prepare('SELECT * FROM message WHERE id_auteur=? AND id_destinataire=? OR id_auteur = ? AND id_destinataire = ? order by date');// Je veux pouvoir consulter mes messages avec un autre utilisateur
        $recupMessages->execute(array($_SESSION['idm'], $_GET['idm'], $_GET['idm'],$_SESSION['idm']));
        while($message = $recupMessages->fetch()){
            if($message['id_destinataire']== $_SESSION['id']){
                ?>
                <p style="color:red;"><?=$message['message'];echo " ".$message['date'];?></p>
                <?php
            }else if (($message['id_destinataire']== $_GET['id'])){
                ?>
                <p style="color:green;"><?=$message['message'];echo " ".$message['date'] ?></p>
                <?php

            }
        }

    ?>





    </section>
    
</body>
</html>