<?php
require("connexionSQL.php");

function modifProfil(PDO $db, $table, $param, $valeur, $id){
    $modif = "UPDATE " .$table ." SET " .$param ."=" .$valeur ." WHERE id =" .$id;
    $prepare = $db->prepare($modif);
    $prepare->execute();
}

function nombrePatient(PDO $db, $id){
    $queryPatient = "SELECT count(*) from user where manager=" .$id;
    $preparePatient = $db->query($queryPatient);
    return $preparePatient->fetchColumn();
}
function nombrePatientRecherche(PDO $db, $id, $recherche){
    $queryPatient = "SELECT count(*) from user where manager=".$id ." AND first_name LIKE '%" .$recherche ."%'";
    $preparePatient = $db->query($queryPatient);
    return $preparePatient->fetchColumn();
}

function infoPatient(PDO $db, $id) {
    $patient = "SELECT * from user where manager=" .$id;
    $prepare = $db->prepare($patient);
    $prepare->execute();
    return $prepare->fetchAll();
} 

function infoPatientRecherche(PDO $db, $id, $value, $recherche) {
    if ($value == 0){
        $patient = "SELECT * FROM user WHERE manager=" .$id ." AND first_name LIKE '%" .$recherche ."%'";
    } elseif ($value == 1){
        $patient = "SELECT * FROM user WHERE manager=" .$id ." AND first_name LIKE '%" .$recherche ."%' ORDER BY first_name";
    } elseif ($value == 2){
        $patient = "SELECT * FROM user WHERE manager=" .$id ." AND first_name LIKE '%" .$recherche ."%' ORDER BY last_name";
    }
    $prepare = $db->prepare($patient);
    $prepare->execute();
    return $prepare->fetchAll();
} 
