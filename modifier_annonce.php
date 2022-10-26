<?php
    require("session.php");
    require("fonction.php");
    require("test.php");
    require_once("header.php");

    

    $ida = $_GET['ida'];
    $annonce = getUneAnnonce($pdo, $ida);
    $titre = $annonce['titre'] ;
    $description = $annonce['lib_a'];
    $prix = $annonce['prix'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bboot.css">
    <title>Inscription</title>
<body>
    <div class="container text-center col-md-6 p-3 rounded-5"><br>
    <div class="bg-light m-5 p-md-5 p-2 shadow rounded">
    <form action="" method="post">
        <h1>Modifier l'annonce</h1><br><br>
        <input class="form-control my-3"  type="text" name="titre"  class="form-control" value="<?=$titre?>">
        <input class="form-control my-3" type="text" name="description"  class="form-control" value="<?=$description?>">
        <input class="form-control my-3" type="number" name="prix"  class="form-control" value="<?=$prix?>"><br>
        <input class="btn btn-dark rounded-3 my-3" type="submit" name="boutton" value="Modifier">
    </form>
    </div>
    </div>
<?php
if(isset($_POST['boutton'])){
    $req="update annonce 
          set lib_a = ?, 
          titre = ?,
          prix = ?
          where ida = '$ida'";


    $statement = $pdo->prepare($req);
    $statement->bindValue(1, $_POST['description'], PDO::PARAM_STR);
    $statement->bindValue(2, $_POST['titre'], PDO::PARAM_STR);
    $statement->bindValue(3, $_POST['prix']);
    

        $statement->execute();
        
        echo "Votre annonce a bien été modifiée";
        //header("refresh: 2; url=creer_annonce.php");



}
?>
<?php require_once("footer.php");?>
</body>

</html>