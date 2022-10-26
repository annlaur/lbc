<?php
require("session.php");
require("fonction.php");
require_once("header.php");
require_once("test.php");

if(isset($_GET['destinataire']) && !empty($_GET['destinataire']))
{
    $destinataire = $_GET['destinataire'];
    $ida =  $_GET['ida'];
    // echo $destinataire.'<br>'.$ida;
   


}else{
    header('location : prcp_annonce.php');

}



?>


<?php

        if(isset($_POST['envoyer'])){
            $message = htmlspecialchars($_POST['message']); // evite que l'utilisateur utilise du html
            $insererMessage= $pdo->prepare("insert into message(ida,message,id_destinataire,id_auteur,date)VALUES('$ida',?,'$destinataire','$idu',NOW())");
            $insererMessage->execute(array($_POST['message']));
        }



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bboot.css">
    <title>Messagerie</title>
</head>
<body>
    
    <div class="container text-center col-md-6 p-3 rounded-5"><br>
    <div class="bg-light m-5 p-md-5 p-2 shadow rounded">
    <h1>Envoyer un message au vendeur</h1><br>
    <form action="" method="POST">

        <textarea class="form-control" name="message" id="" cols="30" rows="10"></textarea>
        <br><br>
        <input class="btn btn-dark rounded-3" type="submit" name="envoyer">
    </form>

    <section id="messages">

    <?php
        /*
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
*/
    ?>





    </section>
    </div>
    </div>
    <?php require_once("footer.php");?>
</body>
</html>