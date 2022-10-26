<?php
	require_once("page_include.php");
	

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="bboot.css">
    <title>Déposer une annonce</title>
	
</head>
<body>

    <div class="container text-center col-md-6 p-3 rounded-5"><br>
    	<div class="bg-light m-5 p-md-5 p-2 shadow rounded">
			<h1>Déposer une annonce</h1><br><br>
    	<form action="" method="post">
        	<p class=" fw-bold" style="color:black;">Titre:</p>
			<input class="form-control my-3" type="text" name="titre" placeholder="Titre de l'annonce" required><br>
			<p class=" fw-bold" style="color:black;">Prix (€):</p>
			<input class="form-control my-3" type="text" name="prix" placeholder="Prix" min=0 required><br>
        	<p class=" fw-bold" style="color:black;">Code Postal:</p>
			<input class="form-control my-3" type="text" name="cp" placeholder="Code Postal" size="6" maxlength="5" required><br>
        	<p class=" fw-bold" style="color:black;">Régions:</p>
			<select class="form-select my-3" placeholder="Choisir la region" name="region">
                	<?php
                    	$req2 = "SELECT * FROM region"; 
                    	
						foreach($pdo->query($req2,PDO::FETCH_ASSOC) as $ligne)
                   		
                    	{
                        	echo "<option value='".$ligne["nomRegion"]."'> ".$ligne["nomRegion"]." </option>";
                    	}
                	?>
        		</select><br><br>
        
			<p class=" fw-bold" style="color:black;">Ville:</p>
			<input class="form-control my-3" type="text" name="ville" placeholder="Ville" required>
			<p class=" fw-bold" style="color:black;">Catégorie: </p>
			<select class="form-select my-3" placeholder="Categorie" name="idc" required>
                	<?php
                    	$req3 = "SELECT * FROM categorie"; 
                    	// $resultat3= mysqli_query($id,$req3);
						foreach($pdo->query($req3,PDO::FETCH_ASSOC)as $ligne)
                   		// while($ligne=mysqli_fetch_assoc($resultat3))
                    	{
                        	echo "<option value =".$ligne['idc']."> ".$ligne["nom_cat"]." </option>";
                    	}
                	?><br>
			</select>
        	<p class=" fw-bold" style="color:black;">Description:</p>
			<textarea class="form-control my-3" name="descrip" placeholder="Description de l'annonce" cols="30" rows="10" required></textarea><br>
        	<!-- Voulez-vous télécharger des images:<input type="radio" name="question" value="1" required><input type="radio" name="question" value="0" required> -->
			<p class=" fw-bold" style="color:black;">Télécharger des images:</p><input class="" type="file" name="img1"><br><br>
			<input class="btn btn-dark rounded-3 my-3" type="submit" name="submit" value="Créer l'annonce" required>	
    </form>
</div>
</div>
<?php
require_once("footer.php");
?>
</body>
</html>

<?php
if(isset($_POST['submit']))
	{
		extract($_POST);
		

		$req="insert into annonce values (null, :idc, :idu, :titre, :lib_a, :prix, now(), 0, null, null)";
		$statement = $pdo->prepare($req);
		$statement->bindValue(':idu',$idu, PDO::PARAM_INT);
		$statement->bindValue(':idc',$idc, PDO::PARAM_INT);
		$statement->bindValue(':titre',$titre, PDO::PARAM_STR);
		$statement->bindValue(':lib_a',$lib_a, PDO::PARAM_STR);
		$statement->bindValue(':prix', $prix);


		$statement->execute();
		// récupérer le dernier ida pour ensuite mettre des images
		$ida = (int) $pdo->lastInsertId('ida');
		var_dump($ida);

		$extensions = array('jpg', 'png', 'gif');

        if (isset($_FILES['img1']) && !$_FILES['img1']['error']) {
         $fileInfo = pathinfo($_FILES['img1']['name']);
            //Tester la taille (limite = 2 mo)
            if ($_FILES['img1']['size'] <= 2000000) {

                //tester l'extension
                if (in_array($fileInfo['extension'], $extensions)) {
                // Scripts à exécuter quand les contrôles sont bons. 
                    $path = $_FILES['img1']['name'];
                    $requete = "insert into image values (null, :ida, :path)";
					$requete2 = "update annonce set img = 1 where ida='$ida'";
                    $statement = $pdo->prepare($requete);
					$statement2 = $pdo->prepare($requete2);
                    $statement->bindValue(':ida', 1, PDO::PARAM_INT);
                    $statement->bindValue(':path', $path, PDO::PARAM_STR);
                    $statement->execute();
					$statement2->execute();

                    move_uploaded_file($_FILES['img1']['tmp_name'], 'img_annonce/'.$_FILES['img1']['name']);
                    echo 'Le fichier a été envoyé sur le serveur';

                } else {
                    echo 'Ce type de fichier est interdit';
                    }
            } else {
                echo 'Le fichier dépasse la taille autorisée';
                }
        } else {
         echo 'Une erreur est survenue lors de l\'envoi du fichier';
         }
		
		echo "Votre annonce a été créée<br>
		<a href='prcp_annonce.php'>redirection sur page principal</a><br>";
		echo "ou <a href='detail_annonce.php?ida=$ida'>Voir mon annonce</a>";
		//header("location:detail_annonce.php");
			
	}
	require_once("footer.php");
?>