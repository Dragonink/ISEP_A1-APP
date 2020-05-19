<?php
require("connexionSQL.php");

function modifProfil(PDO $db, $table, $param, $valeur, $id){
    $modif = "UPDATE " .$table ." SET " .$param ."= '" .$valeur ."' WHERE id = " .$id;
    $prepare = $db->prepare($modif);
    if ($prepare !== FALSE) {
        $prepare->execute();
    } else {
        echo "<script>alert(\"Une erreur est survenue lors de l'enregistrement de vos données.\")</script>";
    }
}
