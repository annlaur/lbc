<?php

//retourne les annonce de l'utilisateur précisé
function getMesAnnonces(PDO $pdo, int $id){
    $vosAnnonces = array();
    $statement = $pdo->prepare("select * from annonce where idu = :idu");
    $statement->bindValue(':idu', $id, PDO::PARAM_INT);

    if($statement->execute()){
        while($annonces = $statement->fetch(PDO::FETCH_ASSOC)){
            $vosAnnonces[] = $annonces;
        }
    }else{
        echo "erreur fonction getFavoris";
    }

    return $vosAnnonces;
}

//retourne le tableau contenant les infos d'une annonce
function getUneAnnonce(PDO $pdo, int $ida){
    $uneAnnonce = array();
    $statement = $pdo->prepare("select * from annonce where ida = :ida");
    $statement->bindValue(':ida', $ida, PDO::PARAM_INT);

    if($statement->execute()){
        while($annonce = $statement->fetch(PDO::FETCH_ASSOC)){
            $uneAnnonce = $annonce;
        }
    }else{
        echo "erreur fonction getUneAnnonce";
    }

    return $uneAnnonce;
}

//retourne toutes les annonces de la base de donnée
function getAllAnnonces(PDO $pdo){

    $allAnnonces = array();
    $query = "SELECT annonce.*, user.ville, user.cp, user.nom 
              FROM annonce, user 
              WHERE annonce.idu = user.idu";
    foreach($pdo->query($query, PDO::FETCH_ASSOC) as $annonce ){
        $allAnnonces[] = $annonce;
    }

    return $allAnnonces;
}

//retourne le chemin d' 1 image si img de bdd =1
//sinon retourne l'image par defaut
function getUneImage(PDO $pdo, int $ida, int $img){
    if($img == 1){
        $query = "select chemin from image where ida = ? limit 1 ";
        $statement = $pdo->prepare($query);
        $statement->bindValue(1, $ida, PDO::PARAM_INT);

        if($statement->execute()){
            while($images = $statement->fetch(PDO::FETCH_ASSOC)){
                $uneImage = $images['chemin'];
            }
        }else{
            echo "erreur fonction getUneImage";
        }
        return 'img_annonce/'.$uneImage;
    }
    else{
        return 'img_annonce/defaut';
    }
}

//Recoit un nom d'image (donc $image['chemin']) et le concatène avec le bon dossier
//  function concatImg($nomImg){
//         return 'img_annonce/'.$nomImg;
//  }
// Est ce utile vu que je peut concatener dans la fonction uneImage ??


function getFavoris(PDO $pdo, int $id){
    $vosFavoris = array();
    $query = "select annonce.ida, user.nom as auteur, annonce.titre, annonce.img
    FROM favoris , annonce , user 
    WHERE favoris.ida = annonce.ida and user.idu = annonce.idu and favoris.idu = :idu";

    //préparer la requête
    $statement = $pdo->prepare($query); 
    //renseigner la valeur du marqueur
    $statement->bindValue(':idu', $id, PDO::PARAM_INT);
    //executer la requête 
    if($statement->execute()){
        while($favoris = $statement->fetch(PDO::FETCH_ASSOC)){
            $vosFavoris[] = $favoris;
        }
    }else{
        echo "erreur fonction getFavoris";
    }

    return $vosFavoris;
}

function getMessages(PDO $pdo, int $id){
    $vosMessages = array();
    $statement = $pdo->prepare("select * from message where idu = :idu");
    $statement->bindValue(':idu', $id, PDO::PARAM_INT);

    if($statement->execute()){
        while($messages = $statement->fetch(PDO::FETCH_ASSOC)){
            $vosMessages[] = $messages;
        }
    }else{
        echo "erreur fonction getFavoris";
    }

    return $vosMessages;
}


//comte le nombre d'image pour l'annonce donnée et retourne le nombre
function countImg(PDO $pdo, int $ida){
    $query = "select count(ida) from image where ida = $ida";
    foreach($pdo->query($query, PDO::FETCH_ASSOC) as $u){
        $cptImg = $u['count(ida)'];
    }
    return $cptImg;
}

function getRegion(PDO $pdo, int $idu)
{
    $request2 = ("select region.nomRegion from user, region where user.idu = '$idu' and region.idr = user.idr");

    foreach($pdo->query($request2, PDO::FETCH_ASSOC) as $u){
                $region = $u['nomRegion'];
            }
            return $region;
}

function getUser(PDO $pdo, int $idu)
{
    $request = ("select * from user where idu = $idu");
    
    foreach($pdo->query($request, PDO::FETCH_ASSOC) as $u){
        $user = $u;
    }
    return $user;
}

function favoris(PDO $pdo, int $ida, $idu) : string {

    foreach($pdo->query("select count(*) from favoris where ida='$ida' and idu='$idu'",PDO::FETCH_ASSOC) as $compte_fav){

        $nbFav = $compte_fav['count(*)']; // on compte les lignes 

        if($nbFav == 0){ //si le favoris n'existe pas deja on rempli l'étoile
            
            return 'img_site/sparkle-bold.svg';

        }else{ //si il existe deja on vide l'étoile
            return 'img_site/sparkle-fill.svg';
        }


    }
}

function LesplusVus (PDO $pdo, int $nb){
    
    foreach($pdo->query("select * from annonce order by cpt_vu DESC limit $nb", PDO::FETCH_NUM) as $tab){
        $plusVus[] = $tab;
    }
    return $plusVus;
}

?>