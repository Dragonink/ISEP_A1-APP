<?php
session_start();
include("../models/requeteModif.php");

function nom(PDO $db, $table){
    modifProfil($db, $table, 'last_name', trim_input($_POST['nom']), $_POST['id']);
    $_SESSION["user_nom"] = trim_input($_POST['nom']);
}

function prenom(PDO $db, $table) {
    modifProfil($db, $table, 'first_name', $_POST['prenom'], $_POST['id']);
    $_SESSION["user_prenom"] = trim_input($_POST['prenom']);
}

function mdp(PDO $db, $table){
    $erreur = false;
    $password = password_hash(trim_input($_POST['mdp']), PASSWORD_DEFAULT);
    if (trim_input($_POST['mdp']) == trim_input($_POST['verifmdp'])){
        modifProfil($db, $table, 'password', $password, $_POST['id']);
    } else {
        echo "<script>alert(\"Le mot de passe ne correspond pas\")</script>";
        $erreur = true;
    }
    return $erreur;
}

function email(PDO $db, $table){
    $erreur = false;
    if (trim_input($_POST['email']) == trim_input($_POST['verifmdp'])){
        modifProfil($db, $table, 'email', trim_input($_POST['email']), $_POST['id']);
        $_SESSION["user_email"] = trim_input($_POST['email']);
    } else {
        echo "<script>alert(\"L'e-mail ne correspond pas\")</script>";
        $erreur = true;
    }
    return $erreur;
}

function medecin(PDO $db, $table){
    modifProfil($db, $table, 'manager', trim_input($_POST['medecin']), $_POST['id']);
    $_SESSION["user_medecin"] = trim_input($_POST['medecin']);
}

function telephone(PDO $db, $table){
    modifProfil($db, $table, 'phone', trim_input($_POST['telephone']), $_POST['id']);
    $_SESSION["user_tel"] = trim_input($_POST['telephone']);
}

function adresse(PDO $db, $table){
    modifProfil($db, $table, 'work_address', trim_input($_POST['adresse']), $_POST['id']);
    $_SESSION["user_adresse"] = trim_input($_POST['adresse']);
}

function checkbox(PDO $db, $table){
    modifProfil($db, $table, 'ack_share', $_POST['checkbox'], $_POST['id']);
    $_SESSION["user_share"] = $_POST['checkbox'];
}
