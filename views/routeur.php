<?php

include("controllers/profil.php");

if (isset($_POST['modifUtilisateur'])){
    $url='utilisateur';
    if (isset($_POST['nom']) && $_POST['nom']!=''){
        nom('user');
    }
    if (isset($_POST['prenom']) && $_POST['prenom']!=''){
        prenom('user');
    }
    if (isset($_POST['mdp']) && $_POST['mdp']!=''){
        $mdperreur=mdp('user');
    }
    if (isset ($_POST['email']) && $_POST['email']!=''){
        $emailerreur=email('user');
    }
    //if (isset ($_POST['photo']) && $_POST['photo']!=''){
    //    photo('user');
    //}
    if (isset($_POST['telephone']) && $_POST['telephone']!=''){
        telephone('user');
    }
    if (isset($_POST['medecin']) && $_POST['medecin']!=''){
        medecin('user');
    }   
    if ($mdperreur=true || $emailerreur=true){
        $url='modifUtilisateur';
    }
    checkbox('user');
    
}elseif (isset($_POST['modifGestionnaire'])){
    $url='gestionnaire';
    if (isset($_POST['nom']) && $_POST['nom']!=''){
        nom('manager');
    }
    if (isset($_POST['prenom']) && $_POST['prenom']!=''){
        prenom('manager');
    }
    if (isset($_POST['mdp']) && $_POST['mdp']!=''){
        $mdperreur=mdp('manager');
    }
    if (isset ($_POST['email']) && $_POST['email']!=''){
        $emailerreur=email('manager');
    }
    //if (isset ($_POST['photo']) && $_POST['photo']!=''){
    //    photo('user');
    //}
    if (isset($_POST['telephone']) && $_POST['telephone']!=''){
        telephone('manager');
    }
    if (isset($_POST['adresse']) && $_POST['adresse']!=''){
        telephone('manager');
    }
    if ($mdperreur=true || $emailerreur=true){
        $url='modifGestionnaire';
    }
}elseif (isset($_POST['modifAdmin'])){
    $url='admin';
    if (isset($_POST['nom']) && $_POST['nom']!=''){
        nom('admin');
    }
    if (isset($_POST['prenom']) && $_POST['prenom']!=''){
        prenom('admin');
    }
    if (isset($_POST['mdp']) && $_POST['mdp']!=''){
        $mdperreur=mdp('admin');
    }
    if (isset ($_POST['email']) && $_POST['email']!=''){
        $emailerreur=email('admin');
    }
    if ($mdperreur=true || $emailerreur=true){
        $url='modifAdmin';
    }
include($url .'.php');