<?php
    require("session.php");
    require("fonction.php");
    require("test.php");

    
    $user = getUser($pdo, $idu);
    $ville = $user['ville'] ;
    $mail = $user['mail'];
    $cp = $user['cp'] ;
    $noms = $user['nom'] ;


    

?>
<body>
    <div class="container">
    <form action="" method="post">
        <input type="text" name="nom"  class="form-control" value="<?=$noms?>">
        <input type="mail" name="mail"  class="form-control" value="<?=$mail?>">
        <input type="text" name="ville"  class="form-control" value="<?=$ville?>">
        <input type="number" name="cp"  class="form-control" value="<?=$cp?>">
        <input type="submit" name="boutton" value="Modifier">
    </form>
    </div>

</body>
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