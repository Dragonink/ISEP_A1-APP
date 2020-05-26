<?php
require("connexionSQL.php");

function modifProfil(PDO $db, $table, $param, $valeur, $id){
    $modif = "";
    if ($table === "user") {
        $modif = "UPDATE " .$table ." SET " .$param ."= '" .$valeur ."' WHERE nss = '" .$id. "'";
    } else {
        $modif = "UPDATE " .$table ." SET " .$param ."= '" .$valeur ."' WHERE id = '" .$id."'";
    }
    $prepare = $db->prepare($modif);
    if ($prepare !== FALSE) {
        $prepare->execute();
    } else {
        setcookie("modifError", "true");
    }
}
