<?php
require "../models/account_info.php";
include("../controllers/profil.php");
function trim_input($data) {
	return htmlspecialchars(stripslashes(trim($data)));
}
$mdperreur=false;
$emailerreur=false;

if (isset($_POST['modifUtilisateur'])){
    $nom = $prenom = $mdp = $email = $telephone = $medecin = "";
    $nom=trim_input($_POST['nom']);
    $prenom=trim_input($_POST['prenom']);
    if (isset($_POST["mdp"])) {$mdp=trim_input($_POST['mdp']);}
    $email=trim_input($_POST['email']);
    $telephone=trim_input($_POST['telephone']);
    $medecin=trim_input($_POST['medecin']);
    $url='utilisateur';
    if (!empty($nom)){
        nom($db, 'user', $nom);
    }
    if (!empty($prenom)){
        prenom($db, 'user', $prenom);
    }
    if (!empty($mdp)){
        $mdperreur=mdp($db, 'user', $mdp);
    }
    if (!empty($email)){
        $emailerreur=email($db, 'user', $email);
    }
    if (!empty($telephone)){
        telephone($db, 'user', $telephone);
    }
    if (!empty($medecin)){
        medecin($db, 'user', $medecin);
    }
    if ($mdperreur==true || $emailerreur==true){
        $url="modifUtilisateur";
    } else {
        setcookie("modifState", "success");
    }
}elseif (isset($_POST['modifGestionnaire'])){
    $nom = $prenom = $mdp = $email = $telephone = $medecin = "";
    $nom=trim_input($_POST['nom']);
    $prenom=trim_input($_POST['prenom']);
    if (isset($_POST["mdp"])) {$mdp=trim_input($_POST['mdp']);}
    $email=trim_input($_POST['email']);
    $telephone=trim_input($_POST['telephone']);
    $adresse=trim_input($_POST['adresse']);
    $url='gestionnaire';
    if (!empty($nom)){
        nom($db, 'manager', $nom);
    }
    if (!empty($prenom)){
        prenom($db,'manager', $prenom);
    }
    if (!empty($mdp)){
        $mdperreur=mdp($db, 'manager', $mdp);
    }
    if (!empty($email)){
        $emailerreur=email($db, 'manager', $email);
    }
    if (!empty($telephone)){
        telephone($db, 'manager', $telephone);
    }
    if (!empty($adresse)){
        adresse($db, 'manager', $adresse);
    }
    if ($mdperreur==true || $emailerreur==true){
        $url="modifGestionnaire";
    } else {
        setcookie("modifState", "success");
    }
}elseif (isset($_POST['modifAdmin'])){
    $nom = $prenom = $mdp = $email = $telephone = $medecin = "";
    $nom=trim_input($_POST['nom']);
    $prenom=trim_input($_POST['prenom']);
    if (isset($_POST["mdp"])) {$mdp=trim_input($_POST['mdp']);}
    $email=trim_input($_POST['email']);
    $url='admin';
    if (!empty($nom)){
        nom($db, 'administrator', $nom);
    }
    if (!empty($prenom)){
        prenom($db,'administrator', $prenom);
    }
    if (!empty($mdp)){
        $mdperreur=mdp($db, 'administrator', $mdp);
    }
    if (!empty($email)){
        $emailerreur=email($db, 'administrator', $email);
    }
    if ($mdperreur==true || $emailerreur==true){
        $url="modifAdmin";
    } else {
        setcookie("modifState", "success");
    }

}
if (isset($_POST['annuler']) || isset($_COOKIE["modifAdmin"])) {
    setcookie("modifAdmin");
    if ($_SESSION["user_type"]=="user"){
        $url='utilisateur';
        $user_info = fetchUser($db, $account);
        $_SESSION["user_prenom"] = $user_info[0]["first_name"];
        $_SESSION["user_nom"] = $user_info[0]["last_name"];
        $_SESSION["user_email"] = $user_info[0]["email"];
        $_SESSION["user_medecin"] = $user_info[0]["manager"];
        $_SESSION["user_tel"] = $user_info[0]["phone"];
    } elseif ($_SESSION["user_type"]=="manager"){
        $url='gestionnaire';
        $user_info = fetchManager($db, $account);
        $_SESSION["user_id"] = $user_info[0]["id"];
        $_SESSION["user_prenom"] = $user_info[0]["first_name"];
        $_SESSION["user_nom"] = $user_info[0]["last_name"];
        $_SESSION["user_email"] = $user_info[0]["email"];
        $_SESSION["user_tel"] = $user_info[0]["phone"];
        $_SESSION["user_adresse"] = $user_info[0]["work_address"];
    } elseif($_SESSION["user_type"]=="administrator"){
        $url='admin';
        if ($_SESSION["user_id"]==$_POST['id']){
            $_SESSION["user_id"] = $user_info[0]["id"];
            $_SESSION["user_prenom"] = $user_info[0]["first_name"];
            $_SESSION["user_nom"] = $user_info[0]["last_name"];
            $_SESSION["user_email"] = $user_info[0]["email"];
        }
    }
}

header("Location:". $url .'.php', true, 303);
exit;
