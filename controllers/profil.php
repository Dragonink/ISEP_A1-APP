<?php
session_start();
include("../models/requeteModif.php");

function nom(PDO $db, $table){
    modifProfil($db, $table, 'last_name', $_POST['nom'], $_SESSION['user_id']);
    $_SESSION["user_nom"] = $_POST['nom'];
}

function prenom(PDO $db, $table) {
    modifProfil($db, $table, 'first_name', $_POST['prenom'], $_SESSION['user_id']);
    $_SESSION["user_prenom"] = $_POST['prenom'];
}

function mdp(PDO $db, $table){
    $erreur = false;
    $password = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
    if ($_POST['mdp'] == $_POST['verifmdp']){
        modifProfil($db, $table, 'password', $password, $_SESSION['user_id']);
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
        $_SESSION["user_email"] = $_POST['email'];
    } else {
        echo "<script>alert(\"L'e-mail ne correspond pas\")</script>";
        $erreur = true;
    }
    return $erreur;
}

function medecin(PDO $db, $table){
    modifProfil($db, $table, 'manager', $_POST['medecin'], $_SESSION['user_id']);
    $_SESSION["user_medecin"] = $_POST['medecin'];
}

function telephone(PDO $db, $table){
    modifProfil($db, $table, 'phone', $_POST['telephone'], $_SESSION['user_id']);
    $_SESSION["user_tel"] = $_POST['telephone'];
}

function adresse(PDO $db, $table){
    modifProfil($db, $table, 'work_address', $_POST['adresse'], $_SESSION['user_id']);
    $_SESSION["user_adresse"] = $_POST['adresse'];
}

function checkbox(PDO $db, $table){
    $ack_share = '0';
    $_SESSION["user_share"] = FALSE;
    if (isset($_POST["checkbox"])) {
        $ack_share = '1';
        $_SESSION["user_share"] = TRUE;
    }
    modifProfil($db, $table, 'ack_share', $ack_share, $_SESSION['user_id']);
}
