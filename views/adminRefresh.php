<?php

include('../controllers/adminDonnees.php');
if (isset($_GET["fonction"])){
    if (($_GET["fonction"]=='dispositif') && (isset($_GET["value"]) && isset($_GET["recherche"]))){
        echo listeInfoDispositif($db, $_GET["value"], $_GET["recherche"]);
    } elseif (($_GET["fonction"]=='utilisateur') && (isset($_GET["value"]) && isset($_GET["recherche"]))){
        echo listeInfoUtilisateur($db, $_GET["value"], $_GET["recherche"]);
    } elseif (($_GET["fonction"]=='requete') && (isset($_GET["value"]))){
        echo listeInfoRequete($db, $_GET["value"]);
    } elseif ($_GET["fonction"]=='ajoutQuestion'){
        echo ajouterQuestion($db);
    } elseif (($_GET["fonction"]=='rejeter') && (isset($_GET["page"]) && isset($_GET["value"]) && isset($_GET["recherche"]) && isset($_GET["id"]) && isset($_GET["origine"]))){
        rejeter($db, $_GET["id"], $_GET["origine"]);
        if ($_GET["page"]=='requete') {
            echo listeInfoRequete($db, $_GET["value"]);
        } elseif ($_GET["page"]=='utilisateur') {
             echo listeInfoUtilisateur($db, $_GET["value"], $_GET["recherche"]);
        }
    } elseif (($_GET["fonction"]=='validAjoutQuestion') && (isset($_GET["question"]) && isset($_GET["answer"]))){
        ajoutQuestion($db, $_GET["question"], $_GET["answer"]);
        echo listeFAQ($db);
    } elseif (($_GET["fonction"]=='modifQuestion') && (isset($_GET["id"]) && isset($_GET["question"]) && isset($_GET["answer"]))){
        modifQuestion($db, $_GET["id"], $_GET["question"], $_GET["answer"]);
        echo listeFAQ($db);
    } elseif (($_GET["fonction"]=='supQuestion') && (isset($_GET["id"]))){
        supQuestion($db, $_GET["id"]);
        echo listeFAQ($db);
    } else {
        echo "erreur";
    }
} 

?>