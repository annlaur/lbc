<?php
session_start();
echo "Vous êtes déconnecté...";
//$_SESSION = array();
session_destroy();
header('refresh:2; url=connexion.php');
?>