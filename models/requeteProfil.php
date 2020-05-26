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
    $test = "SELECT count(*) as nb,type from test where type='freq' and test.exam==exam.id and exam.console==console.id and console.manager==" .$_SESSION['user_id'] ." and result IS NOT NULL union all SELECT count(*) as nb,type from test where type='temp' and test.exam==exam.id and exam.console==console.id and console.manager==" .$_SESSION['user_id'] ." and result IS NOT NULL union all SELECT count(*) as nb,type from test where type='tona' and test.exam==exam.id and exam.console==console.id and console.manager==" .$_SESSION['user_id'] ." and result IS NOT NULL union all SELECT count(*) as nb,type from test where type='stim' and test.exam==exam.id and exam.console==console.id and console.manager==" .$_SESSION['user_id'] ." and result IS NOT NULL union all SELECT count(*) as nb,type from test where type='colo' and test.exam==exam.id and exam.console==console.id and console.manager==" .$_SESSION['user_id'] ." and result IS NOT NULL";
    $prepare = $db->prepare($test);
    $prepare->execute();
    return $prepare->fetchAll();
}

function resulTest(PDO $db, $nom){
    $test ="SELECT result, user.first_name as prenom, user.last_name as nom from test where type='" .$nom ."' and test.exam==exam.id and exam.console==console.id and console.manager==" .$_SESSION['user_id'] ." and user.manager==" .$_SESSION['user_id'] ." and result IS NOT NULL";
    $prepare = $db->prepare($test);
    $prepare->execute();
    return $prepare->fetchAll();
}

function nbTestRealSpec(PDO $db,$choix,$j){
    if ($choix == 1){
        $test = "SELECT count(*) as nb,type from test where type='freq' and test.exam==exam.id and exam.console==console.id and console.manager==" .$_SESSION['user_id'] ." and result IS NOT NULL and user.manager==" .$_SESSION['user_id'] ." and user.id like '".$j."%' union all SELECT count(*) as nb,type from test where type='temp' and test.exam==exam.id and exam.console==console.id and console.manager==" .$_SESSION['user_id'] ." and result IS NOT NULL and user.manager==" .$_SESSION['user_id'] ." and user.id like '".$j."%' union all SELECT count(*) as nb,type from test where type='tona' and test.exam==exam.id and exam.console==console.id and console.manager==" .$_SESSION['user_id'] ." and result IS NOT NULL and user.manager==" .$_SESSION['user_id'] ." and user.id like '".$j."%' union all SELECT count(*) as nb,type from test where type='stim' and test.exam==exam.id and exam.console==console.id and console.manager==" .$_SESSION['user_id'] ." and result IS NOT NULL and user.manager==" .$_SESSION['user_id'] ." and user.id like '".$j."%' union all SELECT count(*) as nb,type from test where type='colo' and test.exam==exam.id and exam.console==console.id and console.manager==" .$_SESSION['user_id'] ." and result IS NOT NULL and user.manager==" .$_SESSION['user_id'] ." and user.id like '".$j."%'";
    } elseif ($choix == 2){
        $test = "SELECT count(*) as nb,type from test where type='freq' and test.exam==exam.id and exam.console==console.id and console.manager==" .$_SESSION['user_id'] ." and result IS NOT NULL and user.manager==" .$_SESSION['user_id'] ." and user.id like '_".$j."%' union all SELECT count(*) as nb,type from test where type='temp' and test.exam==exam.id and exam.console==console.id and console.manager==" .$_SESSION['user_id'] ." and result IS NOT NULL and user.manager==" .$_SESSION['user_id'] ." and user.id like '_".$j."%' union all SELECT count(*) as nb,type from test where type='tona' and test.exam==exam.id and exam.console==console.id and console.manager==" .$_SESSION['user_id'] ." and result IS NOT NULL and user.manager==" .$_SESSION['user_id'] ." and user.id like '_".$j."%' union all SELECT count(*) as nb,type from test where type='stim' and test.exam==exam.id and exam.console==console.id and console.manager==" .$_SESSION['user_id'] ." and result IS NOT NULL and user.manager==" .$_SESSION['user_id'] ." and user.id like '_".$j."%' union all SELECT count(*) as nb,type from test where type='colo' and test.exam==exam.id and exam.console==console.id and console.manager==" .$_SESSION['user_id'] ." and result IS NOT NULL and user.manager==" .$_SESSION['user_id'] ." and user.id like '_".$j."%'";
    }
    $prepare = $db->prepare($test);
    $prepare->execute();
    return $prepare->fetchAll();
}

function mTestRealSpec( PDO $db,$choix,$nom,$j){
    if ($choix == 1){
        $test = "SELECT result from test where type='" .$nom ."' and test.exam==exam.id and exam.console==console.id and console.manager==" .$_SESSION['user_id'] ." and result IS NOT NULL and user.manager==" .$_SESSION['user_id'] ." and user.id like '".$j."%'";
    } elseif ($choix == 2){
        $test = "SELECT result from test where type='" .$nom ."' and test.exam==exam.id and exam.console==console.id and console.manager==" .$_SESSION['user_id'] ." and result IS NOT NULL and user.manager==" .$_SESSION['user_id'] ." and user.id like '_".$j."%'";
    }
    $prepare = $db->prepare($test);
    $prepare->execute();
    return $prepare->fetchAll();
}