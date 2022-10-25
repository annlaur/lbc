<?php 
require("session.php");
require("fonction.php");
require("test.php");
$pdo->exec("SET NAMES utf8");
?>
<h1>Bonjour <?= $nom ?></h1>
<body>
    <div class="row">

       <div class="col">
            <h2>Profil</h2>
            Nom : <?= $nom?><br>
            Ville : <br>
            Code postal : <br>
            mail : <?= $mail?><br>
            <a href="modifier_user.php">Modifier mes informations</a>

       </div>
        
        <div class="col">
            <h2>Vos annonces :</h2>
            <!-- <?php 
                $vosAnnonces = getMesAnnonces($pdo, $idu);
                foreach($vosAnnonces as $annonces){ 
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

            <a href="gerer_annonce.php">Gérer mes annonces</a> -->
            <?php require("gerer_annonce.php");
                    ?>
        </div>
                    

    </div> 
    <div class="row">

        <div class="col">
            <h2>Messagerie</h2>
            <?php
            
            $recupMessages= $pdo->prepare("SELECT * FROM message WHERE id_auteur='$idu' OR id_destinataire = '$idu' order by date");// Je veux pouvoir consulter mes messages avec un autre utilisateur
            $recupMessages->execute();
    while($message = $recupMessages->fetch()){
        $auteur=getUser($pdo,$message['id_auteur']);
        $nom_auteur=$auteur['nom'];
        
        if($message['id_destinataire'] == $idu){
            ?>

            <p style="color:red;"><?=$message['message'];echo " ".$message['date'];echo " ".$nom_auteur;?></p>
            <?php
        }else if (($message['id_auteur'] == $idu)){
            ?>
            <p style="color:green;"><?=$message['message'];echo " ".$message['date'];echo " ".$nom; ?></p>
            <?php
    
        }
    }



    ?>
                    
         




            
        </div>

        <div class="col">
            <h2>Vos favoris</h2>
            <?php
               
               $vosFavoris = getFavoris($pdo, $idu);
               

               foreach($vosFavoris as $favoris){
                $image = getUneImage($pdo, $favoris['ida'],$favoris['img']);
                
                ?>
                <div class="card mb-3 h-auto" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                        <img src="<?= $image ?>" class="img-fluid rounded-start" alt="...">
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

    </div>
</body>

