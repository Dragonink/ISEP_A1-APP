<?php
session_start();
include('../controllers/adminDonnees.php');
if (isset($_GET["fonction"])){
    if (($_GET["fonction"]=='dispositif') && (isset($_GET["value"]) && isset($_GET["recherche"]))){
        echo listeInfoDispositif($db, $_GET["value"], $_GET["recherche"]);
    } elseif (($_GET["fonction"]=='utilisateur') && (isset($_GET["value"]) && isset($_GET["recherche"]))){
        echo listeInfoUtilisateur($db, $_GET["value"], $_GET["recherche"]);
    } elseif ($_GET["fonction"]=='listeManager'){
        echo listeManager($db);
    } elseif (($_GET["fonction"]=='requete') && (isset($_GET["value"]))){
        echo listeInfoRequete($db, $_GET["value"],$_SESSION["user_email"]);
    } elseif ($_GET["fonction"]=='ajoutQuestion'){
        echo ajouterQuestion($db);
    } elseif (($_GET["fonction"]=='rejeter') && (isset($_GET["page"]) && isset($_GET["value"]) && isset($_GET["recherche"]) && isset($_GET["id"]) && isset($_GET["origine"]))){
        rejeter($db, $_GET["id"], $_GET["origine"]);
        if ($_GET["page"]=='requete') {
            echo listeInfoRequete($db, $_GET["value"],$_SESSION["user_email"]);
        } elseif ($_GET["page"]=='utilisateur') {
            echo listeInfoUtilisateur($db, $_GET["value"], $_GET["recherche"]);
        }
    } else if (($_GET["fonction"]=='validerRequete') && (isset($_GET["value"]) && isset($_GET["id"]) && isset($_GET["origine"]))){
        validerRequete($db, $_GET["id"], $_GET["origine"]);
        echo listeInfoRequete($db, $_GET["value"],$_SESSION["user_email"]);
    } else if (($_GET["fonction"]=='bannir') && (isset($_GET["value"]) && isset($_GET["recherche"]) && isset($_GET["id"]) && isset($_GET["origine"]))){
        bannir($db, $_GET["id"], $_GET["origine"]);
        echo listeInfoUtilisateur($db, $_GET["value"], $_GET["recherche"]);
    } elseif (($_GET["fonction"]=='validAjoutQuestion') && (isset($_GET["question"]) && isset($_GET["answer"]) && isset($_GET["id"]))){
        ajoutQuestion($db, $_GET["question"], $_GET["answer"], $_GET["id"]);
        echo listeFAQ($db);
    } elseif (($_GET["fonction"]=='modifQuestion') && (isset($_GET["id"]) && isset($_GET["question"]) && isset($_GET["answer"]) && isset($_GET["admin"]))){
        modifQuestion($db, $_GET["id"], $_GET["question"], $_GET["answer"], $_GET["admin"]);
        echo listeFAQ($db);
    } elseif (($_GET["fonction"]=='supQuestion') && (isset($_GET["id"]))){
        supQuestion($db, $_GET["id"]);
        echo listeFAQ($db);
    } elseif (($_GET["fonction"]=='addDispositif') && (isset($_GET["value"]) && isset($_GET["recherche"]) && isset($_GET["code"]) && isset($_GET["manager"]))){
        if (nbIdDispositif($db)<2){
            if (idDispositif($db)== false || $_GET["code"]!=idDispositif($db)){
                ajoutDispositif($db, $_GET["code"], $_GET["manager"]);
            }else{
                ajoutDispositif1($db, $_GET["code"], $_GET["manager"]);
            }
        }else{
            if (!in_array($_GET["code"],idDispositif($db))){
                ajoutDispositif($db, $_GET["code"], $_GET["manager"]);
            }else{
                ajoutDispositif1($db, $_GET["code"], $_GET["manager"]);
            }
        }
        echo listeInfoDispositif($db, $_GET["value"], $_GET["recherche"]);
    } elseif (($_GET["fonction"]=='supDispositif') && (isset($_GET["value"]) && isset($_GET["recherche"]) && isset($_GET["id"]))){
        supDispositif($db, $_GET["id"]);
        echo listeInfoDispositif($db, $_GET["value"], $_GET["recherche"]);
    } elseif ($_GET["fonction"]=='nbRequete'){
        echo nombreRequete($db);
    } elseif ($_GET["fonction"]=='nbRequeteAdmin'){
        echo nombreRequeteAdmin($db);
    } elseif ($_GET["fonction"]=='nbRequeteManager'){
        echo nombreRequeteManager($db);
    } elseif ($_GET["fonction"]=='nbUtilisateur'){
        echo nombreUtilisateur($db);
    } elseif ($_GET["fonction"]=='nbConsoles'){
        echo nombreDispositif($db);
    } elseif ($_GET["fonction"]=='nbTest'){
        echo nombreTestsRealises($db);
    }elseif (($_GET["fonction"]=='envoieMailValidation')&& (isset($_GET["envoi"]) && isset($_GET["recev"]))){
        envoieMailValidation($_GET["envoi"],$_GET["recev"]);
    }elseif (($_GET["fonction"]=='envoieMailAnnulation')&& (isset($_GET["envoi"]) && isset($_GET["recev"]))){
        envoieMailAnnulation($_GET["envoi"],$_GET["recev"]);
    } else {
        echo "</br>Les données rentrées ne sont pas correctes!";
    }
}

?>
