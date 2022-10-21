<?php
require("test.php");
    $pdo = new PDO('mysql:host=localhost:3307;dbname=lbc', 'root', '');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion/creation</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
  
<div class="container border border-secondary border-opacity-10 text-center col-4 mt-5 p-3 rounded-5">
    <form  action="" method="post">
        <div class="connexion">
            <h2>Se connecter</h2>
            <div class="form-group mb-3">
            <input type="email" name="mail" placeholder="mail"required class="form-control rounded-4">
            </div>
            <div class="form-group mb-3">
            <input type="password" name="mdp"placeholder="mot de passe" required class="form-control rounded-4">
            </div>
            <input type="submit" name="bout"value="se connecter" class="btn btn-primary mb-3 rounded-3">
            <br>
            <a href="mdp.php">Mot de passe oublié ?</a>
        </div>
        
    </form>
    </div>
    <?php
        if(isset($_POST["bout"])){
            //verifier si tout est bon
            $mail=$_POST["mail"];
            $mdp=$_POST["mdp"];
            foreach ($pdo->query("select * from user where mail='$mail' and mdp='$mdp'", PDO::FETCH_ASSOC) as $li)
            if(count($li)>0){
                //creer variable de session
                session_start();
                $_SESSION["mail"]=$li["mail"];
                $_SESSION["nom"]=$li["nom"];
                $_SESSION["idu"]=$li["idu"];
                //entrer sur page d'acceuil
                 header("location:profil.php");
            }else{
                echo "erreur mot de passe ou mail";
            }
        }
            
            
        

    ?>
</body>
</html>