<?php 
require_once("session.php");
require("test.php");
?>
<body style="background-color: rgb(17, 92, 255);">

    <div class=" col-md-8 m-5">
        <div class="bg-light m-5 p-md-5 shadow rounded">
            <form action="" method="post">
                <h1 class="text-center fw-bold m-1" style="color: rgb(17, 92, 255);">Déposer une annonce</h1>
                    <!-- <input class="form-control my-3 w-50 " type="file" name="photo" placeholder="telecharger une image" required> -->
                    <input class="form-control my-3 w-50 " type="text" name="titre" placeholder="Titre de l'annonce" required>
                    <input class="form-control my-3 w-50 " type="number" name="prix" placeholder="Prix (€)" required min="0">
                    <select name="categorie"> 
                        <option value="1">cat 1</option>
                        <option value="2">cat 2</option>
                        <option value="3">cat 3</option>
                        <option value="4">cat 4</option>
                    </select>
                    <textarea class="form-control form-control-sm " name="descri" placeholder="Description de l'annonce"  cols="100" rows="10"></textarea>

                    <div class="text-center my-5">
                        <input class="btn btn-primary" type="submit" name="submit" value="Poster l'annonce">
                    </div>
            </form>
        </div>
    </div>
        

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
</body>
</html>

<?php
if(isset($_POST["submit"]))
{
 echo "TEST!!!!!!";
    // if(!isset($_POST['photo'])) throw new Exception("Le paramètre email est absent");
    if(!isset($_POST['titre'])) throw new Exception("Le paramètre titre est absent");
    $titre = $_POST['titre'];
    if(!isset($_POST['prix'])) throw new Exception("Le paramètre prix est absent");
    $prix = $_POST['prix'];
    if(!isset($_POST['categorie'])) throw new Exception("Le paramètre categorie est absent");
    $idc = $_POST['categorie'];
    if(!isset($_POST['descri'])) throw new Exception("Le paramètre description est absent");
    $lib_a = $_POST['descri'];





    $req="insert into annonce values (null, :idc, :idu, :titre , :lib_a, :prix, :d , null, null)";
    $statement = $pdo->prepare($req);
    $statement->bindValue(':idu',$idu, PDO::PARAM_INT);
    $statement->bindValue(':idc',$idc, PDO::PARAM_INT);
    $statement->bindValue(':titre',$titre, PDO::PARAM_STR);
    $statement->bindValue(':lib_a',$lib_a, PDO::PARAM_STR);
    $statement->bindValue(':prix', $prix);
    $statement->bindValue(':d', date("Y-m-d H:i:s"));

        $statement->execute();
        // récupérer le dernier ida pour ensuite mettre des images
        $ida = $pdo->lastInsertId();
        echo "Votre annonce a bien été créer";
        header("refresh: 2; url=creer_annonce.php");


   
}


?>