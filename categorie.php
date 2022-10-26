<?php 
require_once("page_include.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion/creation</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="bboot.css">
</head>
<body style = "background-color: rgb(251, 246, 208);">

<div class="container text-center col-md-6 p-3 rounded-5"><br>
<div class="bg-light m-5 p-md-5 p-2 shadow rounded">
<h1>Choisir la catégorie de l'annonce</h1><br>
<form class="text-center" action="" method="post">
    <select class="form-select my-3" style="width: 200px;" placeholder="Categorie" name="idc" required>
                        <?php
                            $req3 = "SELECT * FROM categorie"; 
                            
                            foreach($pdo->query($req3,PDO::FETCH_ASSOC)as $ligne)
                            
                            {
                                echo "<option value =".$ligne['idc']."> ".$ligne["nom_cat"]." </option>";
                            }
                        ?><br>
    </select>
    <input class="btn btn-dark rounded-3 my-3" type="submit" value="choisir" name="sub">
</form>
</div>
</div>
<?php
if(isset($_POST['sub']))
{
    $nbCat = $_POST["idc"];
    $allAnnonces = array();
    $query = "select annonce.*, user.ville, user.cp, user.nom, categorie.nom_cat FROM annonce, user, categorie WHERE annonce.idu = user.idu and annonce.idc = categorie.idc and annonce.idc = '$nbCat'";
    foreach($pdo->query($query, PDO::FETCH_ASSOC) as $annonce ){
        $allAnnonces[] = $annonce;
    }




foreach($allAnnonces as $annonce){
        $ida = $annonce['ida'];
        $fav = favoris($pdo, $ida, $idu);
        $image = getUneImage($pdo, $annonce['ida'],$annonce['img']);
        $sousTitre = $annonce['nom'].' '.$annonce['ville'].' '.$annonce['cp'];
        //substr pour n'afficher que les 100 premiers caractères de la description dans les petites cartes
        $description = substr($annonce['lib_a'], 0, 100);
        
?>
        <div class="card container mb-3" style="width: 1100px; border-width: 5px; border-color: black; background-color: #f1ebdf;" >
            <div class="row">
                <div class="col-md-4 px-0">
                    <img src='<?= $image ?>' style="height: 250px; width: 250px;" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body px-0">
                        <h5 class="card-title"><?= $annonce['titre']?></h5>
                        <p class="card-text"><small class="text-muted"><?= $sousTitre?></small></p>
                        <p class="card-text text-success"><strong><?= $annonce['prix'] ?> €</strong></p>
                        <p class="card-text"><?= $description ?> ....</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        <p class="card-text"><a href="detail_annonce.php?ida=<?=$ida?>">détail</a>
                        </p>
                    </div>
                </div>
            </div>
            
                <span class="position-absolute top-0 start-100 translate-middle p-2">
                    <a href='favoris.php?ida=<?=$ida?>'>
                    <img src='<?= $fav ?>' alt="star">
                    </a>
                </span>
            
        </div>

    <?php } }?>



<div class="sticky-bottom  float-end">
    <a href="creer_annonce.php" target="_blank" rel="noopener noreferrer">
        <img src="img_site/plus-circle.svg" alt="PLUS">
    </a>
</div>




    <!-- Les scripts de fins sont a mettre dans le fichier footer a require
     sur toute les pages -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
</body>
</html>