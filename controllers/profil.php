<?php 

include("models/requeteProfil.php");

function nom($table){
    modifProfil($db, $table, 'last_name', $_POST['nom'], $_SESSION['id']);
}

function prenom($table) {
    modifProfil($db, $table, 'first_name', $_POST['prenom'], $_SESSION['id']);
}

function mdp($table){
    $erreur = false;
    if ($_POST['mdp'] == $_POST['verifmdp']){
        modifProfil($db, $table, 'password', $_POST['mdp'], $_SESSION['id']);
    } else {
        echo "<script>alert(\"Le mot de passe ne correspond pas\")</script>";
        $erreur = true;
    }
    return $erreur;
}

function email($table){
    $erreur = false;
    if ($_POST['email'] == $_POST['verifmdp']){
        modifProfil($db, $table, 'email', $_POST['email'], $_SESSION['id']);
    } else {
        echo "<script>alert(\"L'e-mail ne correspond pas\")</script>";
        $erreur = true;
    }
    return $erreur
}

function medecin($table){
    modifProfil($db, $table, 'manager', $_POST['medecin'], $_SESSION['id']);
}

function telephone($table){
    modifProfil($db, $table, 'phone', $_POST['telephone'], $_SESSION['id']);
}

function photo($table){
    modifProfil($db, $table, 'picture', $_POST['photo'], $_SESSION['id']);
}

function adresse($table){
    modifProfil($db, $table, 'work_address', $_POST['adresse'], $_SESSION['id']);
}

function checkbox($table){
    modifProfil($db, $table, 'ack_share', $_POST['checkbox'], $_SESSION['id']);
}
?>