<?php 
include("../models/forget.php");

function compte(PDO $db, $mail, $mdp){
    if (verifMail($db, $mail)>0){
        modifmdp($db, origineMail($db, $mail)[0]['origine'], $mail, $mdp);
        return true;
    } else {
        return false;
    }
}