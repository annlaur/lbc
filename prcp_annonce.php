<?php 
require("session.php");
require("fonction.php");
require("test.php");
?>
<body>
<div class="row my-3"> header, jeanne</div>
<div class="row my-3"> nav, jeanne<</div>
<div class="row my-3"> partie filtrage, recherche et categorie, jeanne</div>

<div class="row p-5 my-5 border">

    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
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


<div class="">
<?php
    $allAnnonces = getAllAnnonces($pdo);
    foreach($allAnnonces as $annonce){
        $image = getUneImage($pdo, $annonce['ida'],$annonce['img']);
        $sousTitre = $annonce['nom'].' '.$annonce['ville'].' '.$annonce['cp'];
        //substr pour n'afficher que les 100 premiers caractères de la description dans les petites cartes
        $description = substr($annonce['lib_a'], 0, 100);
        
?>
        <div class="card container mb-3 " >
            <div class="row">
                <div class="col-md-4">
                    <img src='<?= $image ?>' style="height: 250px; width: 250px;" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><?= $annonce['titre']?></h5>
                        <p class="card-text"><small class="text-muted"><?= $sousTitre?></small></p>
                        <p class="card-text"><?= $annonce['prix'] ?></p>
                        <p class="card-text"><?= $description ?> ....</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
            </div>
        </div>

    <?php } ?>
</div>




    <!-- Les scripts de fins sont a mettre dans le fichier footer a require
     sur toute les pages -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
</body>
