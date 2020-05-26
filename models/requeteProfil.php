<?php
require("connexionSQL.php");

function nombrePatient(PDO $db, $id){
    $queryPatient = "SELECT count(*) from user where manager=" .$id;
    $preparePatient = $db->query($queryPatient);
    return $preparePatient->fetchColumn();
}
function nombrePatientRecherche(PDO $db, $id, $recherche){
    $queryPatient = "SELECT count(*) from user where manager=".$id ." AND CONCAT(nss, first_name, last_name) LIKE '%" .$recherche ."%'";
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
        $patient = "SELECT * FROM user WHERE manager=" .$id ." AND nss LIKE '%" .$recherche ."%' ORDER BY nss";
    } elseif ($value == 1){
        $patient = "SELECT * FROM user WHERE manager=" .$id ." AND first_name LIKE '%" .$recherche ."%' ORDER BY first_name";
    } elseif ($value == 2){
        $patient = "SELECT * FROM user WHERE manager=" .$id ." AND last_name LIKE '%" .$recherche ."%' ORDER BY last_name";
    }
    $prepare = $db->prepare($patient);
    $prepare->execute();
    return $prepare->fetchAll();
} 

function nbTestReal(PDO $db){
    $test = "SELECT count(type) as nb,type from test full join exam on test.exam=exam.id full join console on exam.console=console.id where console.manager=" .$_SESSION['user_id'] ." and result IS NOT NULL groub by type";
    $prepare = $db->prepare($test);
    $prepare->execute();
    return $prepare->fetchAll();
}

function resulTest(PDO $db, $nom){
    $test ="SELECT result, user.first_name as prenom, user.last_name as nom from test full join exam on test.exam=exam.id full join console on exam.console=console.id where type='" .$nom ."' console.manager=" .$_SESSION['user_id'] ." and user.manager=" .$_SESSION['user_id'] ." and result IS NOT NULL";
    $prepare = $db->prepare($test);
    $prepare->execute();
    return $prepare->fetchAll();
}

function nbTestRealSpec(PDO $db,$choix,$j){
    if ($choix == 1){
        $test = "SELECT count(type) as nb,type from test full join exam on test.exam=exam.id full join console on exam.console=console.id full join user on exam.user=user.nss where console.manager=" .$_SESSION['user_id'] ." and result IS NOT NULL and user.manager=" .$_SESSION['user_id'] ." and user.nss like '".$j."%' ";
    } elseif ($choix == 2){
        $test = "SELECT count(type) as nb,type from test full join exam on test.exam=exam.id full join console on exam.console=console.id full join user on exam.user=user.nss where console.manager=" .$_SESSION['user_id'] ." and result IS NOT NULL and user.manager=" .$_SESSION['user_id'] ." and user.nss like '_".$j."%'";
    }
    $prepare = $db->prepare($test);
    $prepare->execute();
    return $prepare->fetchAll();
}

function mTestRealSpec( PDO $db,$choix,$nom,$j){
    if ($choix == 1){
        $test = "SELECT result from test full join exam on test.exam=exam.id full join console on exam.console=console.id full join user on exam.user=user.nss where type='" .$nom ."' and console.manager=" .$_SESSION['user_id'] ." and result IS NOT NULL and user.manager=" .$_SESSION['user_id'] ." and user.id like '".$j."%'";
    } elseif ($choix == 2){
        $test = "SELECT result from test full join exam on test.exam=exam.id full join console on exam.console=console.id full join user on exam.user=user.nss where type='" .$nom ."' and console.manager=" .$_SESSION['user_id'] ." and result IS NOT NULL and user.manager=" .$_SESSION['user_id'] ." and user.id like '_".$j."%'";
    }
    $prepare = $db->prepare($test);
    $prepare->execute();
    return $prepare->fetchAll();
}