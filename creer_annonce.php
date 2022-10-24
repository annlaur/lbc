<?php
require("session.php");
require("fonction.php");
require_once("header.php");
require_once("test.php");



if(isset($_POST['submit']))
{
	extract($_POST);
	

$req="insert into annonce values (null, :idc, :idu, :titre, :lib_a, :prix, now(), 0, null, null)";
$statement = $pdo->prepare($req);
$statement->bindValue(':idu',$idu, PDO::PARAM_INT);
$statement->bindValue(':idc',$idc, PDO::PARAM_INT);
$statement->bindValue(':titre',$titre, PDO::PARAM_STR);
$statement->bindValue(':lib_a',$descrip, PDO::PARAM_STR);
$statement->bindValue(':prix', $prix);


    $statement->execute();
    // récupérer le dernier ida pour ensuite mettre des images
    $ida = $pdo->lastInsertId('ida');
    // echo "Votre annonce a bien été créer";
	header("location:detail_annonce.php");
	
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
        Titre:
		<input type="text" name="titre" placeholder="Titre de l'annonce" required><br>
		Prix:
		<input type="text" name="prix" placeholder="Prix" min=0 required>€<br>
        Code Postal:
		<input type="text" name="cp" placeholder="Code Postal" size="6" maxlength="5" required><br>
        Régions:
		<select placeholder="Choisir la region" name="region">
                	<?php
                    	$req2 = "SELECT DISTINCT nomRegion FROM region"; 
                    	
						foreach($pdo->query($req2,PDO::FETCH_ASSOC) as $ligne)
                   		
                    	{
                        	echo "<option value='".$ligne["nomRegion"]."'> ".$ligne["nomRegion"]." </option>";
                    	}
                	?>
        		</select><br><br>
        
        Ville:
		<input type="text" name="ville" placeholder="Ville" required>
		Catégorie: 
		<select placeholder="Categorie" name="idc" required>
                	<?php
                    	$req3 = "SELECT DISTINCT nom_cat FROM categorie"; 
                    	// $resultat3= mysqli_query($id,$req3);
						foreach($pdo->query($req3,PDO::FETCH_ASSOC)as $ligne)
                   		// while($ligne=mysqli_fetch_assoc($resultat3))
                    	{
                        	echo "<option value='".$ligne["idc"]."'> ".$ligne["nom_cat"]." </option>";
                    	}
                	?><br>
        Description:
		<textarea name="descrip" placeholder="Description de l'annonce" cols="30" rows="10" required></textarea><br>
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
