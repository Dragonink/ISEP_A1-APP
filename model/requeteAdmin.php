<?php

include("requeteGenerique.php"); 

function nombreUtilisateur(PDO $db):int {
    $query = 'SELECT count(*) from administrator,user ,manager  where administrator.is_active=1 and manager.is_active=1';
    return $bdd->query($query)->fetchAll();
}

?>