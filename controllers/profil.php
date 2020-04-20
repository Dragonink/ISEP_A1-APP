<?php 
session_start();
include("../models/requeteProfil.php");

function nom(PDO $db, $table){
    modifProfil($db, $table, 'last_name', $_POST['nom'], $_SESSION['user_id']);
}

function prenom(PDO $db, $table) {
    modifProfil($db, $table, 'first_name', $_POST['prenom'], $_SESSION['user_id']);
}

function mdp(PDO $db, $table){
    $erreur = false;
    if ($_POST['mdp'] == $_POST['verifmdp']){
        modifProfil($db, $table, 'password', $_POST['mdp'], $_SESSION['user_id']);
    } else {
        echo "<script>alert(\"Le mot de passe ne correspond pas\")</script>";
        $erreur = true;
    }
    return $erreur;
}

function email(PDO $db, $table){
    $erreur = false;
    if ($_POST['email'] == $_POST['verifmdp']){
        modifProfil($db, $table, 'email', $_POST['email'], $_SESSION['user_id']);
    } else {
        echo "<script>alert(\"L'e-mail ne correspond pas\")</script>";
        $erreur = true;
    }
    return $erreur;
}

function medecin(PDO $db, $table){
    modifProfil($db, $table, 'manager', $_POST['medecin'], $_SESSION['user_id']);
}

function telephone(PDO $db, $table){
    modifProfil($db, $table, 'phone', $_POST['telephone'], $_SESSION['user_id']);
}

function photo(PDO $db, $table){
    modifProfil($db, $table, 'picture', $_POST['photo'], $_SESSION['user_id']);
}

function adresse(PDO $db, $table){
    modifProfil($db, $table, 'work_address', $_POST['adresse'], $_SESSION['user_id']);
}

function checkbox(PDO $db, $table){
    modifProfil($db, $table, 'ack_share', $_POST['checkbox'], $_SESSION['user_id']);
}
?>