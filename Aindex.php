<!-- ATTENTION !!!!!
CECI EST LA PAGE prcp POUR LES VISITEUR NON CONNECTES/INSCRITS
 QUI N'ONT AUCUN DROIT, 
 QUELQUE SOIT LE LIEN QU'ILS CLIQUENT,
 ILS SONT RENVOYES SUR LA PAGE CONNEXION/INSCRIPTION
 -->
<?php 

$pdo = new PDO('mysql:host=localhost:3307;dbname=lbc', 'root', '');
require("fonction.php");
require("test.php");
require_once("Aheader.php");
//var_dump(LesplusVus($pdo, 6));
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
<body>



<div class="row p-3 my-5 text-center border" style="width: 1000px; margin-left: 250px;">

    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" >
    <div class="carousel-inner">
 <!-- dans le carousel on affiche les 9 annonces les plus vu  -->
        <div class="carousel-item active"> <!-- SLIDE 1 -->
            <div class="row">
                <?php for($i=0;$i<3;$i++){ ?>
                    <div class = "col-md-4 mb-3">
                         <div class="card" style="width: 10rem;">
                            <img src="img_annonce/defaut.jpg" class="img-fluid card-img-top" alt="...">
                            <div class="card-body">
                                <p class="card-text">Les plus vues</p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php for($i=0;$i<2;$i++){ ?>
            <div class="carousel-item">
            <div class="row">
                    <?php for($i=0;$i<3;$i++){?>
                        
                        <div class = "col-md-4 mb-3">
                            <div class="card" style="width: 10rem;">
                                <img src="img_annonce/defaut.jpg" class="img-fluid card-img-top" alt="...">
                                <div class="card-body">
                                    <p class="card-text">Les plus vues</p>
                                </div>
                            </div>
                        </div>
                    <?php  } ?>
                </div>
            
            </div>
        <?php } ?>

    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
    </div>

</div>



<?php
    $allAnnonces = getAllAnnonces($pdo);
    foreach($allAnnonces as $annonce){
        $ida = $annonce['ida'];
        $image = getUneImage($pdo, $annonce['ida'],$annonce['img']);
        $sousTitre = $annonce['nom'].' '.$annonce['ville'].' '.$annonce['cp'];
        //substr pour n'afficher que les 100 premiers caract??res de la description dans les petites cartes
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
                        <p class="card-text text-success"><strong><?= $annonce['prix'] ?> ???</strong></p>
                        <p class="card-text"><?= $description ?> ....</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        <p class="card-text"><a href="connexionTemp.php">d??tail</a>
                        </p>
                    </div>
                </div>
            </div>
            
                <span class="position-absolute top-0 start-100 translate-middle p-2">
                    <a href="connexionTemp.php">
                    <img src='img_site/sparkle-bold.svg' alt="star">
                    </a>
                </span>
            
        </div>

    <?php } ?>



<div class="sticky-bottom  float-end">
    <a href="connexionTemp.php" target="_blank" rel="noopener noreferrer">
        <img src="img_site/plus-circle.svg" alt="PLUS">
    </a>
</div>




    <!-- Les scripts de fins sont a mettre dans le fichier footer a require
     sur toute les pages -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
</body>
</html>
