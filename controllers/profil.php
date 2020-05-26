<?php
include("../models/requeteModif.php");

function nom(PDO $db, $table, $value){
    modifProfil($db, $table, 'last_name', $value, $_POST['id']);
    if (!isset($_COOKIE["modifAdmin"])) {$_SESSION["user_nom"] = $value;}
}

function prenom(PDO $db, $table, $value) {
    modifProfil($db, $table, 'first_name', $value, $_POST['id']);
    if (!isset($_COOKIE["modifAdmin"])) {$_SESSION["user_prenom"] = $value;}
}

function mdp(PDO $db, $table, $value){
    $erreur = false;
    $password = password_hash($value, PASSWORD_DEFAULT);
    if ($value == trim_input($_POST['verifmdp'])){
        modifProfil($db, $table, 'password', $password, $_POST['id']);
    } else {
        setcookie("modifError", "mdp");
        $erreur = true;
    }
    return $erreur;
}

function email(PDO $db, $table, $value){
    $erreur = false;
    if ($value == trim_input($_POST['verifemail'])){
        modifProfil($db, $table, 'email', $value, $_POST['id']);
        if (!isset($_COOKIE["modifAdmin"])) {$_SESSION["user_email"] = $value;}
    } else {
        setcookie("modifError", "email");
        $erreur = true;
    }
    return $erreur;
}

function medecin(PDO $db, $table, $value){
    modifProfil($db, $table, 'manager', $value, $_POST['id']);
    if (!isset($_COOKIE["modifAdmin"])) {$_SESSION["user_medecin"] = $value;}
}

function telephone(PDO $db, $table, $value){
    modifProfil($db, $table, 'phone', $value, $_POST['id']);
    if (!isset($_COOKIE["modifAdmin"])) {$_SESSION["user_tel"] = $value;}
}

function adresse(PDO $db, $table, $value){
    modifProfil($db, $table, 'work_address', $value, $_POST['id']);
    if (!isset($_COOKIE["modifAdmin"])) {$_SESSION["user_adresse"] = $value;}
}
