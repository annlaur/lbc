<?php
require("session.php");
require("fonction.php");
require_once("header.php");
require_once("test.php");

// $idu= 1;

//$id = mysqli_connect("127.0.0.1","root","","lbc");
//mysqli_query($id, "SET NAMES utf8");


if(isset($_POST['submit']))
{
	extract($_POST);

$req="insert into annonce values (null, :idu, :idc, :titre, :lib_a, now(), null, null,:prix, 0)";
$statement = $pdo->prepare($req);
$statement->bindValue(':idu',$idu, PDO::PARAM_INT);
$statement->bindValue(':idc',$idc, PDO::PARAM_INT);
$statement->bindValue(':titre',$titre, PDO::PARAM_STR);
$statement->bindValue(':lib_a',$lib_a, PDO::PARAM_STR);
$statement->bindValue(':prix', $prix);


    $statement->execute();
    // récupérer le dernier ida pour ensuite mettre des images
    $ida = $pdo->lastInsertId();
    // echo "Votre annonce a bien été créer";

	// header("location:detail_annonce.php?ida='$ida'");
	
}

// $region = getRegion($pdo, $annonce['idu']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Déposer une annonce</title>
	
</head>
<body>
    <form action="" method="post">
        Titre:<input type="text" name="titre" placeholder="Titre de l'annonce" required>
		Prix:<input type="text" name="prix" placeholder="Prix" min=0 required>€
        Code Postal:<input type="text" name="cp" placeholder="Code Postal" size="6" maxlength="5" required>
        Régions:<select placeholder="Choisir la region" name="region">
                	<?php
                    	$req2 = "SELECT DISTINCT nomRegion FROM region"; 
                    	//$resultat2= mysqli_query($id,$req2);
						foreach($pdo->query($req2,PDO::FETCH_ASSOC) as $ligne)
                   		//while($ligne=mysqli_fetch_assoc($resultat2))
                    	{
                        	echo "<option value='".$ligne["nomRegion"]."'> ".$ligne["nomRegion"]." </option>";
                    	}
                	?>
        		</select><br><br>
        
        Ville:<input type="text" name="ville" placeholder="Ville" required>
		Catégorie: <select placeholder="Categorie" name="idc" required>
                	<?php
                    	$req3 = "SELECT DISTINCT nom_cat FROM categorie"; 
                    	// $resultat3= mysqli_query($id,$req3);
						foreach($pdo->query($req3,PDO::FETCH_ASSOC)as $ligne)
                   		// while($ligne=mysqli_fetch_assoc($resultat3))
                    	{
                        	echo "<option value='".$ligne["idc"]."'> ".$ligne["nom_cat"]." </option>";
                    	}
                	?>
        Description:<textarea name="descrip" placeholder="Description de l'annonce" cols="30" rows="10" required></textarea>
        <!-- Voulez-vous télécharger des images:<input type="radio" name="question" value="1" required><input type="radio" name="question" value="0" required> -->
		Télécharger des images:<input class="" type="text" name="photo" value="https://fakeimg.pl/300/">
		<input type="submit" name="submit" value="Créer l'annonce" required>	
    </form>

<!-- <?php
$req4 = "select * from annonce order by date desc";
$annonce = $pdo->query($req4);

while ($a = $annonce->fetch())
{
	?>
		<li><a href="detail_annonce.php?ida=<?=$a['ida']?>"><?= $a['titre']?></a></li>
	<?php
}
?> -->

</body>
</html>
