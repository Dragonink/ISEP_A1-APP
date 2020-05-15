<?php

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
    $mdp=trim_input($_POST['mdp']);
    $email=trim_input($_POST['email']);
    $telephone=trim_input($_POST['telephone']);
    $medecin=trim_input($_POST['medecin']);
    $url='utilisateur';
    if (isset($nom) && $nom!=''){
        nom($db, 'user');
    }
    if (isset($prenom) && $prenom!=''){
        prenom($db, 'user');
    }
    if (isset($mdp) && $mdp!=''){
        $mdperreur=mdp($db, 'user');
    }
    if (isset ($email) && $email!=''){
        $emailerreur=email($db, 'user');
    }
    //if (isset ($_POST['photo']) && $_POST['photo']!=''){
    //    photo('user');
    //}
    if (isset($telephone) && $telephone!=''){
        telephone($db, 'user');
    }
    if (isset($medecin) && $medecin!=''){
        medecin($db, 'user');
    }
    if ($mdperreur==true || $emailerreur==true){
        $url="modifUtilisateur";
    }
    checkbox($db, 'user');

}elseif (isset($_POST['modifGestionnaire'])){
    $nom = $prenom = $mdp = $email = $telephone = $medecin = "";
    $nom=trim_input($_POST['nom']);
    $prenom=trim_input($_POST['prenom']);
    $mdp=trim_input($_POST['mdp']);
    $email=trim_input($_POST['email']);
    $telephone=trim_input($_POST['telephone']);
    $adresse=trim_input($_POST['adresse']);
    $url='gestionnaire';
    if (isset($nom) && $nom!=''){
        nom($db, 'manager');
    }
    if (isset($prenom) && $prenom!=''){
        prenom($db,'manager');
    }
    if (isset($mdp) && $mdp!=''){
        $mdperreur=mdp($db, 'manager');
    }
    if (isset ($email) && $email!=''){
        $emailerreur=email($db, 'manager');
    }
    if (isset($telephone) && $telephone!=''){
        telephone($db, 'manager');
    }
    if (isset($adresse) && $adresse!=''){
        telephone($db, 'manager');
    }
    if ($mdperreur==true || $emailerreur==true){
        $url="modifGestionnaire";
    }
}elseif (isset($_POST['modifAdmin'])){
    $nom = $prenom = $mdp = $email = $telephone = $medecin = "";
    $nom=trim_input($_POST['nom']);
    $prenom=trim_input($_POST['prenom']);
    $mdp=trim_input($_POST['mdp']);
    $email=trim_input($_POST['email']);
    $url='admin';
    if (isset($nom) && $nom!=''){
        nom($db, 'admin');
    }
    if (isset($prenom) && $prenom!=''){
        prenom($db,'admin');
    }
    if (isset($mdp) && $mdp!=''){
        $mdperreur=mdp($db, 'admin');
    }
    if (isset ($email) && $email!=''){
        $emailerreur=email($db, 'admin');
    }
    if ($mdperreur==true || $emailerreur==true){
        $url="modifAdmin";
    }
}elseif (isset($_POST['annuler'])) {
    if ($_SESSION["user_type"]=="user"){
        $url='utilisateur';
    } elseif ($_SESSION["user_type"]=="manager"){
        $url='gestionnaire';
    } elseif($_SESSION["user_type"]=="administrator"){
        $url='admin';
    }
}

header("Location:". $url .'.php', true, 303);
exit;
