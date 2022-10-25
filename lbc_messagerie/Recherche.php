<?php
session_start();
$bdd = new PDO('mysql:dbname=messages_prives;host=localhost', 'root', '');
$allusers = $bdd->query('SELECT * FROM users ORDER BY id DESC');
if(isset($_GET['s']) AND !empty($_GET['s'])){
    $recherche= htmlspecialchars($_GET['s']);
    $allusers=$bdd->query('SELECT * FROM users where pseudo LIKE "%'.$recherche.'%" ORDER BY id DESC'); // mettre une etoile

}
/*if(!$_SESSION['pseudo']){
    header('Location: connexion.php');
}*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action=""method="GET">
        <input type="search" name="s" placeholder="Rechercher un utilisateur">
        <input type="submit" name="envoyer">
    </form>

    <section class="Afficher_utilisateur">
        <?php
            
            if($allusers->rowCount()>0){
                while($user=$allusers->fetch()){
                    ?>
                    <p><?= $user['pseudo'];?></p>
                    
                    
                    <?php
                }
            }else{
                ?>
                <p>Aucun utilisateur trouvé</p>
                <?php
            }

        ?>

    </section>
    
</body>
</html>