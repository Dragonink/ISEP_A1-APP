<?php
require("connexionSQL.php");

function verifMail(PDO $db, $mail){
    $queryAdmin = "SELECT count(*) from administrator where email='" .$mail ."'";
    $queryUser = "SELECT count(*) from user where email='" .$mail ."'";
    $queryMan = "SELECT count(*) from manager where email='" .$mail ."'";
    $prepareAdmin = $db->query($queryAdmin);
    $nbAdmin = $prepareAdmin->fetchColumn();
    $prepareUser = $db->query($queryUser);
    $nbUser = $prepareUser->fetchColumn();
    $prepareMan = $db->query($queryMan);
    $nbMan = $prepareMan->fetchColumn();
    return ($nbAdmin + $nbUser + $nbMan);
}

function origineMail(PDO $db, $mail){
    $utilisateur = "SELECT 'administrator' as origine from administrator where email='" .$mail ."' UNION SELECT 'user' as origine from user where email='" .$mail ."' UNION SELECT 'manager' as origine from manager where email='" .$mail ."'";
    return $db->query($utilisateur)->fetchColumn();
}

function modifmdp(PDO $db, $table, $mail, $mdp){
    $mdp = password_hash($mdp, PASSWORD_DEFAULT);
    $modif = "UPDATE " .$table ." SET password='" .$mdp ."' WHERE email ='" .$mail."'";
    $db->prepare($modif)->execute();
}
