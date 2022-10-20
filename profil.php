<?php 
require("session.php");
require("fonction.php");
require("test.php");
?>
<h1>Bonjour <?= $nom ?></h1>
<body>
    <div class="row">

        <div class="col">
            <h2>Vos favoris</h2>
            <?php
               
               $vosFavoris = getFavoris($pdo, $idu);
               $vosAnnonces = getMesAnnonces($pdo, $idu);

               foreach($vosFavoris as $favoris){?>
                <div class="card mb-3 h-auto" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                        <img src="..." class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?=$favoris['auteur']?></h5>
                                <p class="card-text"><?=$favoris['titre']?></p>
                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        
        <div class="col">
            <h2>Vos annonces :</h2>
            <?php foreach($vosAnnonces as $annonces){ 
                $image = getUneImage($pdo, $annonces['ida'],$annonces['img']);
            ?>

            <div class="card border-light" style="max-width:200px">
                <img class="card-img-top" src=<?= $image ?> alt="Card image" style="width:100%">
                <div class="card-body">
                    <h4 class="card-title"><?= $annonces['prix'] ?> €</h4>
                    <p class="card-text"><?= $annonces['cpt_vu'] ?> Vues</p>
                    <p class="card-text"><?= $annonces['cpt_like'] ?> favoris</p>
                </div>
            </div>
            <br>
            <?php } ?>

            <a href="gerer_annonce.php">Gérer mes annonces</a>
        </div>


    </div> 
</body>

