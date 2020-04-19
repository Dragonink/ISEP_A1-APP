<?php

include("controllers/profil.php");
function trim_input($data) {
	return htmlspecialchars(stripslashes(trim($data)));
}

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
        nom('user');
    }
    if (isset($prenom) && $prenom!=''){
        prenom('user');
    }
    if (isset($mdp) && $mdp!=''){
        $mdperreur=mdp('user');
    }
    if (isset ($email) && $email!=''){
        $emailerreur=email('user');
    }
    //if (isset ($_POST['photo']) && $_POST['photo']!=''){
    //    photo('user');
    //}
    if (isset($telephone) && $telephone!=''){
        telephone('user');
    }
    if (isset($medecin) && $medecin!=''){
        medecin('user');
    }   
    if ($mdperreur=true || $emailerreur=true){
        $url='modifUtilisateur';
    }
    checkbox('user');
    
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
        nom('manager');
    }
    if (isset($prenom) && $prenom!=''){
        prenom('manager');
    }
    if (isset($mdp) && $mdp!=''){
        $mdperreur=mdp('manager');
    }
    if (isset ($email) && $email!=''){
        $emailerreur=email('manager');
    }
    //if (isset ($_POST['photo']) && $_POST['photo']!=''){
    //    photo('user');
    //}
    if (isset($telephone) && $telephone!=''){
        telephone('manager');
    }
    if (isset($adresse) && $adresse!=''){
        telephone('manager');
    }
    if ($mdperreur=true || $emailerreur=true){
        $url='modifGestionnaire';
    }
}elseif (isset($_POST['modifAdmin'])){
    $nom = $prenom = $mdp = $email = $telephone = $medecin = "";
    $nom=trim_input($_POST['nom']);
    $prenom=trim_input($_POST['prenom']);
    $mdp=trim_input($_POST['mdp']);
    $email=trim_input($_POST['email']);
    $url='admin';
    if (isset($nom) && $nom!=''){
        nom('admin');
    }
    if (isset($prenom) && $prenom!=''){
        prenom('admin');
    }
    if (isset($mdp) && $mdp!=''){
        $mdperreur=mdp('admin');
    }
    if (isset ($email) && $email!=''){
        $emailerreur=email('admin');
    }
    if ($mdperreur=true || $emailerreur=true){
        $url='modifAdmin';
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

include($url .'.php');