<body>
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
<table class="table table-striped">
<!-- critère : modifier et supprimer avec message de confirmation -->
    <tr>
        <th>Titre</th>
        <th>Photo</th>
        <th>Vu</th>
        <th><!--modifier--></th>
        <th><!--supprimer--></th>

    </tr>

<?php
    require("session.php");
    require("fonction.php");
    require("test.php");

    $vosAnnonces = getMesAnnonces($pdo, $idu);
    foreach($vosAnnonces as $annonce){
        $ida = $annonce['ida'];
        $cptImg = countImg($pdo, $ida);

        if($annonce['cpt_vu'] > 100){
            $vue = "<span class='badge text-bg-success'> + de 100  </span>";
        }
        elseif($annonce['cpt_vu'] > 20 and $annonce['cpt_vu'] < 100) {
            $vue = "<span class='badge text-bg-warning'> + de 20 </span>";
        }
        else {
            $vue = "<span class='badge text-bg-danger'> - de 20 </span>";
        }

        
       if($annonce['img'] == 1){
        
        $badgeImg = "<span class='badge text-bg-success'>$cptImg</span>";
       }
       else{
        $badgeImg = "<span class='badge text-bg-danger' data-bs-toggle='tooltip' data-bs-placement='right' data-bs-title='Tooltip on right'>rajouter une photo</span>";
       }
       ?>

        <tr>
            <td><?=$annonce['titre']?></td>
            <td><?php echo $badgeImg; ?> </td> 
            <td><?php echo $vue; ?></td>
            <td><a href="modifier_annonce.php?ida=<?=$ida?>">modifier</a></td>

            <td>
            
                <!-- Button trigger modal -->            
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?= $ida ?>">
                Supprimer 
                </button>
                    

                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop<?= $ida ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Suppression définitive</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        souhaitez vous vraiment supprimer cette annonce ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">annuler</button>
                        <a href="supprimer_annonce.php?ida=<?=$ida?>">
                            <button type="button" class="btn btn-primary">supprimer</button>
                            
                        </a>
                    </div>
                    </div>
                </div>
                </div>
             

            </td>
        </tr>

<?php } ?>
</table>
</body>
