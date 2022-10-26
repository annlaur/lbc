<?php
session_start();
echo 'vous allez êtres déconnecté(e) dans 3 sec...';
session_destroy();
header('refresh:3; url=connexionTemp.php');
?>