<?php
require_once("page_include.php");

if(isset($_GET['ida']) && !empty($_GET['ida']))
{
    $ida = (int) $_GET['ida'];
    $annonce = getUneAnnonce($pdo, $ida);


}else{
    header('location : prcp_annonce.php');

}

$region = getRegion($pdo, $annonce['idu']);
$image = getUneImage($pdo, $annonce['ida'],$annonce['img']);
$user = getUser($pdo, $annonce['idu']);
$destinataire=$annonce['idu'];


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=S, initial-scale=1.0">
    <title><?= $annonce["titre"]?></title>
    <link rel="stylesheet" href="bboot.css">
</head>
<body>

<div class="container text-center col-md-8 p-3 rounded-5"><br>
    <div class="bg-light m-5 p-md-5 p-2 shadow rounded">
        <h1><?=$annonce["titre"]?></h1><br>

        <img src="<?= $image?>"><br>
        <h4><?= $user["ville"]?></h4><h4><?= $region ?></h4><br>
        <h4><?= $user["cp"]?></h4><br>
        <p><?= $annonce["lib_a"]?></p>

        <a href="messagerie.php?destinataire=<?=$destinataire?>&ida=<?=$ida?>">CONTACTER LE VENDEUR</a>
    </div>
</div>


</body>
</html>