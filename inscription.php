<?php
require("session.php");
require("fonction.php");
require_once("test.php");

if(isset($_POST['valid']))
{
    extract($_POST);
	#le hachage le plus sécurisé , la chaine de caractère change à change fois 
    $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);

    $pdo->query("INSERT into user VALUES (null, '$idr','$mail','$mdp','$prenom','$ville','$cp')", PDO::FETCH_ASSOC) ;
    $statement = $pdo->prepare($req);
    $statement->bindValue(':idr',$idr, PDO::PARAM_INT);
    $statement->bindValue(':mail',$mail, PDO::PARAM_STR);
    $statement->bindValue(':mdp',$mdp, PDO::PARAM_STR);
    $statement->bindValue(':prenom',$prenom, PDO::PARAM_STR);
    $statement->bindValue(':ville',$ville, PDO::PARAM_STR);
    $statement->bindValue(':cp',$cp, PDO::PARAM_STR);



    $statement->execute();
    // $req="INSERT INTO user VALUES (null,'$mail','$mdp', '$prenom', '$ville','$cp')";

    header("location:connexionTemp.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bboot.css">
    <title>Inscription</title>
</head>
<body>
    <div class="row">
    <div class="container text-center col-4  p-3 rounded-5">
            <img class="text-center" src="img_logo/vame5.png">
        </div>
    </div>
    <div class="row">
    <div class="container text-center col-md-6 p-3 rounded-5"><br>
    <div class="bg-light m-5 p-md-5 p-2 shadow rounded">
    <h1>S'inscrire</h1><br><br>

    <form action="" method="post">

        <input class="form-control my-3" type="text" placeholder="Prénom" name="prenom" required><br><br>
        <input class="form-control my-3" type="email" placeholder="Adresse Mail" name="mail" required><br><br>
        <input class="form-control my-3" type="password" placeholder="Mot de passe" name="mdp" min=10 required><br><br>
        <select class="form-select my-3" placeholder="Choisir la region" name="idr" required>
                	<?php
                    	$req2 = "select * from region"; 
                    	//$resultat2= mysqli_query($id,$req2);
						foreach($pdo->query($req2,PDO::FETCH_ASSOC) as $ligne)
                   		//while($ligne=mysqli_fetch_assoc($resultat2))
                    	{
                        	echo "<option value=".$ligne['idr']."> ".$ligne['nomRegion']." </option>";
                    	}
                	?>
        		</select><br><br>
        <input class="form-control my-3" type="text" placeholder="Ville" name="ville" required><br><br>
        <input class="form-control my-3" type="text" placeholder="Code Postal" name="cp" required><br><br>
        

        <div class="text-center m-5">
        <input type="submit" value="S'INSCRIRE" name="valid" class="btn btn-dark mb-3 rounded-3">
        </div>
    </form>
    <div class="text-center m-5">
    <p>Vous êtes déja inscrit? </p><a style="color:black" href="connexionTemp.php"><p>Connectez-vous</p></a>
    </div>
    </div>
    </div>
    </div>



    <?php require_once("footer.php");?>
</body>
</html>
