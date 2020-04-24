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
    return $prepareMan->fetchColumn();
}

function infoPatient(PDO $db, $id) {
    $patient = "SELECT * from user where manager=" .$id;
    $prepare = $db->prepare($patient);
    $prepare->execute();
    return $prepare->fetchAll();
} 