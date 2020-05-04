<?php 
session_start();
include("../models/forget.php");

function compte( $mail, $mdp){
    if (verifMail($db, $mail)>0){
        modifmdp($db, origineMail($db, $mail)[0]['origine'], $mail, $mdp);
        return true;
    } else {
        return false;
    }
}