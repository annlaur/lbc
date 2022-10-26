<?php
    require("session.php");
    require("fonction.php");
    require("test.php");
    require_once("header.php");

    
    $user = getUser($pdo, $idu);
    $ville = $user['ville'] ;
    $mail = $user['mail'];
    $cp = $user['cp'] ;
    $noms = $user['nom'] ;


    

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
        <h1>Modifier mes informations</h1><br>
    <form action="" method="post">
        <input class="form-control my-3" type="text" name="nom"  class="form-control" value="<?=$nom?>">
        <input class="form-control my-3" type="mail" name="mail"  class="form-control" value="<?=$mail?>">
        <input class="form-control my-3" type="text" name="ville"  class="form-control" value="<?=$ville?>">
        <input class="form-control my-3" type="number" name="cp"  class="form-control" value="<?=$cp?>">
        <input class="btn btn-dark rounded-3 my-3" type="submit" name="boutton" value="Modifier">
    </form>
    </div>
</div>
<?php
if(isset($_POST['boutton'])){
    $req="update user 
          set nom = ?, 
          mail = ?,
          ville = ?,
          cp = ?
          where idu = '$idu'";


    $statement = $pdo->prepare($req);
    $statement->bindValue(1, $_POST['nom'], PDO::PARAM_STR);
    $statement->bindValue(2, $_POST['mail'], PDO::PARAM_STR);
    $statement->bindValue(3, $_POST['ville']);
    $statement->bindValue(4, $_POST['cp'], PDO::PARAM_INT);
    

        $statement->execute();
        
        echo "Votre user a bien été modifiée";
        header("location:profil.php");



}
?>

</body>
<?php require_once("footer.php");?>
</html>
