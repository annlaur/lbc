<body>


    <form method="post" enctype="multipart/form-data">
        image 1 : 
        <input type="file" name="img[]" multiple><br>
        <input type="submit" name="sub" value="envoyer">
    </form>



</body>
</html>
<?php
    require("session.php");
    require("test.php");

    if(isset($_POST['sub'])){

        print_r($_FILES);
        
        $extensions = array('jpg', 'png', 'gif');

        if (isset($_FILES['img1']) && !$_FILES['img1']['error']) {
         $fileInfo = pathinfo($_FILES['img1']['name']);
            //Tester la taille (limite = 2 mo)
            if ($_FILES['img1']['size'] <= 2000000) {

                //tester l'extension
                if (in_array($fileInfo['extension'], $extensions)) {
                // Scripts à exécuter quand les contrôles sont bons. 
                    $path = $_FILES['img1']['name'];
                    $requete = "insert into image values (null, :ida, :path)";
                    $statement = $pdo->prepare($requete);
                    $statement->bindValue(':ida', 1, PDO::PARAM_INT);
                    $statement->bindValue(':path', $path, PDO::PARAM_STR);
                    $statement->execute();

                    move_uploaded_file($_FILES['img1']['tmp_name'], 'img_annonce/'.$_FILES['img1']['name']);
                    echo 'Le fichier a été envoyé sur le serveur';

                } else {
                    echo 'Ce type de fichier est interdit';
                    }
            } else {
                echo 'Le fichier dépasse la taille autorisée';
                }
        } else {
         echo 'Une erreur est survenue lors de l\'envoi du fichier';
         }


    }
    
?>