<?php
require("session.php");
require("fonction.php");
require_once("header.php");
require_once("test.php");

if(isset($_GET['ida']) && !empty($_GET['ida']))
{
    $destinataire=$_GET['ida'];
    echo $destinataire;
   


}else{
    header('location : prcp_annonce.php');

}



?>


<?php

        if(isset($_POST['envoyer'])){
            $message = htmlspecialchars($_POST['message']); // evite que l'utilisateur utilise du html
            $insererMessage= $pdo->prepare("INSERT INTO message(message,id_destinataire,id_auteur,date)VALUES('$destinataire','$idu',?,NOW())");
            $insererMessage->execute(array($_POST['message']));
        }



?>
<body>
    <form action="" method="POST">

        <textarea name="message" id="" cols="30" rows="10"></textarea>
        <br><br>
        <input type="submit" name="envoyer">
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
    
</body>
</html>