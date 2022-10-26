<?php
require("test.php");
    $pdo = new PDO('mysql:host=localhost;dbname=lbc', 'root', '');
    // $pdo = new PDO('mysql:host=localhost:3307;dbname=lbc','root', '');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion/creation</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="bboot.css">
</head>
<body style = "background-color: rgb(242, 237, 201);">

    
    
<div class="row">
    
        <div class="container text-center col-4  p-3 rounded-5">
            <img class="text-center" src="img_logo/vame5.png">
        </div>
      
        <!-- <div class="container border border-secondary border-opacity-10 text-center col-4 mt-5 p-3 rounded-5">
            <form  action="" method="post">
                <div class="connexion">
                        <h2>Connexion</h2>
                    <div class="form-group mb-3">
                        <input type="email" name="mail" placeholder="mail"required class="form-control rounded-4">
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" name="mdp"placeholder="mot de passe" required class="form-control rounded-4">
                    </div>
                    
                </div>
            </form> -->
</div>  
<div class="row">    
    <div class="container text-center col-md-6 p-3 rounded-5">
        <div class="bg-light m-5 p-md-5 p-2 shadow rounded">
            <form  action="" method="post">
                <div class="connexion">
                    <h2 class="text-center fw-bold my-3 mb-3" >Se connecter</h2>
                    
                    <input class="form-control my-3" type="email" name="mail" placeholder="mail"required >  
                    <input class="form-control my-3" type="password" name="mdp"placeholder="mot de passe" required >
                    <div class="text-center m-5">
                        <input type="submit" name="bout"value="SE CONNECTER" class="btn btn-dark mb-3 rounded-3">
                    <br>
                   
                    </div>
                </div>
        
            </form>
            <div class="text-center m-5">
            <a class="textalign-center" style="color:black" href="inscription.php">Inscrivez-vous</a>
            </div>
        </div>
    </div>
</div> 

    <?php
        if(isset($_POST["bout"])){
            //verifier si tout est bon
            $mail=$_POST["mail"];
            $mdp=$_POST["mdp"];
            foreach ($pdo->query("select * from user where mail='$mail' ", PDO::FETCH_ASSOC) as $li)
            if(count($li)>0){
                $passwordHash = $li['mdp'];
                if(password_verify($mdp, $passwordHash)){
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
        }
        

    ?>
    
</body>
</html>
