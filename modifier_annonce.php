<?php
    require("session.php");
    require("fonction.php");
    require("test.php");

    

    $ida = $_GET['ida'];
    $annonce = getUneAnnonce($pdo, $ida);
    $titre = $annonce['titre'] ;
    $description = $annonce['lib_a'];
    $prix = $annonce['prix'];

?>
<body>
    <form action="" method="post">
        <input type="text" name="titre"  class="form-control" value="<?=$titre?>">
        <input type="text" name="description"  class="form-control" value="<?=$description?>">
        <input type="number" name="prix"  class="form-control" value="<?=$prix?>">
        <input type="submit" name="boutton" value="Modifier">
    </form>

</body>
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