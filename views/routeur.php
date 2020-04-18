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
}elseif (isset($_POST['inscription'])){
    $url='inscription';
    if (isset ($_POST['type']) && $_POST['type']=='user'){
        if (issset($_POST['firstname']) && $_POST['firstname']==''){
            echo "<script>alert(\"Le prénom n'est pas renseigné'\")</script>";
        }
        elseif (isset($_POST['lastname']) && $_POST['lastname']==''){
            echo "<script>alert(\"Le nom n'est pas renseigné'\")</script>";
        }
        elseif (isset($_POST['email']) && $_POST['email']==''){
            echo "<script>alert(\"L'e-mail n'est pas renseigné'\")</script>";
        }
        elseif (isset($_POST['password']) && $_POST['password']==''){
            echo "<script>alert(\"Le mot de passe n'est pas renseigné'\")</script>";
        }
        elseif (isset($_POST['nss']) && $_POST['nns']==''){
            echo "<script>alert(\"Le numéro de sécurité sociale n'est pas renseigné'\")</script>";
        }
        elseif (isset($_POST['linked-manager']) && $_POST['linked-manager']=='' ){
            echo "<script>alert(\"Le médecin n'est pas renseigné'\")</script>";
        } else {
            $erreur=inscriptionUtilisateur();
            if ($erreur== false){
                $url='utilisateur';
            }
        }
    }

    elseif (isset ($_POST['type']) && $_POST['type']=='manager'){
        if (issset($_POST['firstname']) && $_POST['firstname']==''){
            echo "<script>alert(\"Le prénom n'est pas renseigné'\")</script>";
        }
        elseif (isset($_POST['lastname']) && $_POST['lastname']==''){
            echo "<script>alert(\"Le nom n'est pas renseigné'\")</script>";
        }
        elseif (isset($_POST['email']) && $_POST['email']==''){
            echo "<script>alert(\"L'e-mail n'est pas renseigné'\")</script>";
        }
        elseif (isset($_POST['password']) && $_POST['password']==''){
            echo "<script>alert(\"Le mot de passe n'est pas renseigné'\")</script>";
        }
        elseif (isset($_POST['address']) && $_POST['address']==''){
            echo "<script>alert(\"Le numéro de sécurité sociale n'est pas renseigné'\")</script>";
        }
        else {
            inscriptionManager();
        }
    }
    
}    



include($url .'.php');