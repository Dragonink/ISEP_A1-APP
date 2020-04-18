<?php

require("connexionSQL.php");

function modifProfil(PDO $db, $table, $param, $valeur, $id){
    $modif = "UPDATE " .$table ." SET " .$param ."=" .$valeur ." WHERE id =" .$id;
    $prepare = $db->prepare($modif);
    $prepare->execute();
}