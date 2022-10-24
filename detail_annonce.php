<?php
require("session.php");
require("fonction.php");
require_once("header.php");
require_once("test.php");

if(isset($_GET['ida']) && !empty($_GET['ida']))
{
    $ida = (int) $_GET['ida'];
    var_dump($ida);
    $annonce = getUneAnnonce($pdo, $ida);


}else{
    header('location : prcp_annonce.php');

}

$region = getRegion($pdo, $annonce['idu']);
$image = getUneImage($pdo, $annonce['ida'],$annonce['img']);
$user = getUser($pdo, $annonce['idu']);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=S, initial-scale=1.0">
    <title><?= $annonce["titre"]?></title>
</head>
<body>
    <h1><?=$annonce["titre"]?></h1><br>
    
    <img src="<?= $image?>"><br>
    <h4><?= $user["ville"]?></h4><h4><?= $region ?></h4><br>
    <h4><?= $user["cp"]?></h4><br>
    <p><?= $annonce["lib_a"]?></p>

    <a href="messagerie.php">CONTACTER LE VENDEUR</a>


</body>
</html>