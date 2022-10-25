<?php
require("session.php");
require("fonction.php");
require_once("header.php");
require_once("test.php");

if(isset($_POST['valid']))
{
    extract($_POST);
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
    <link rel="stylesheet" href="bn.css">
    <title>Inscription</title>
</head>
<body>


    <div class="aze"><br>
    <h1>Je m'enregistre</h1><br><br>

    <form action="" method="post">

        <input type="text" placeholder="Prénom" name="prenom" required><br><br>
        <input type="email" placeholder="Adresse Mail" name="mail" required><br><br>
        <input type="password" placeholder="Mot de passe" name="mdp" required><br><br>
        <select placeholder="Choisir la region" name="idr" required>
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
        <input type="text" placeholder="Ville" name="ville" required><br><br>
        <input type="text" placeholder="Code Postal" name="cp" required><br><br>
        <!-- <input type="file" placeholder="Avatar" name="avatar"><br><br> -->

        
        <input type="submit" value="S'inscrire" name="valid">
    </form><br>

    <p>Vous êtes déja inscrit? </p><a href="connexionTemp.php"><p>Connectez-vous</p></a><br>
    </div>


    
</body>
</html>