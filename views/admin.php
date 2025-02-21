<?php
session_start();
require '../controllers/adminDonnees.php';
if (isset($_COOKIE["modifState"])) {
    setcookie("modifState");
	echo "<script>alert('Vos modifications ont bien été enregistrées.')</script>";
}
?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <!-- JS -->
        <script src="js/admin.js"></script>
        <script type="text/javascript" src="js/lib/RGraph.common.core.js" ></script>
        <script type="text/javascript" src="js/lib/RGraph.common.key.js"></script>
        <script type="text/javascript" src="js/lib/RGraph.hbar.js" ></script>

        <!-- CSS -->
        <link rel="stylesheet" href="css/header-footer.css"/>
        <link href="css/admin.css" rel="stylesheet" type="text/css">

    </head>
    <body>
        <?php require "_header.php"; ?>
        <main>
            <section id="contenuAdmin">
                <div class="requetes" style="display: none;">
                    <div class="content">
                        <div id="menuRequetes">
                            <button class= "demande actif" onclick="openRequete(0)"> Toutes les demandes (<span id='nbRequete'><?php echo nombreRequete($db) ?></span>) </button>
                            <button class= "demande" onclick="openRequete(1)"><img src="images/iconSecurite.png"> Demandes administrateur (<span id='nbRequeteAdmin'><?php echo nombreRequeteAdmin($db) ?></span>) </button>
                            <button class= "demande" onclick="openRequete(2)"><img src="images/iconDispositif.png"> Demandes médecins (<span id='nbRequeteManager'><?php echo nombreRequeteManager($db) ?></span>) </button>
                        </div>
                        <div id="affichageRequetes">
                            <button class="close" onclick="closeRequetes()"><img src="images/iconCroix.png"></button>
                            <div id="requete" class="requete"><?php echo listeInfoRequete($db, 0, $_SESSION["user_email"]) ?></div>
                        </div>
                    </div>
                </div>
                <div id="menuAdmin">
                    <button class= "chapitre actif" onclick="openChapitre(0)"><img src="images/iconDashboard.png"/> Dashboard </button>
                    <button class= "chapitre" onclick="openChapitre(1)"><img src="images/iconDispositif.png"> Dispositifs </button>
                    <button class= "chapitre" onclick="openChapitre(2)"><img src="images/iconUtilisateur.png"> Utilisateurs </button>
                    <button class= "chapitre" onclick="openChapitre(3)"><img src="images/iconFAQ.png"> FAQ </button>
                </div>
                <div id="affichageAdmin">
                    <div id="0" class="choix" style="display: block;">
                        <div id="adminDashboard">
                            <h1> Dashboard </h1>
                            <div class="chiffreCle">
                                <div class = "visites"><h3>Total des utilisateurs:</h3> &nbsp; <h2 id='nbUtilisateur'><?php echo nombreUtilisateur($db) ?></h2></div>
                                <div class = "consoles"><h3> Total des dispositifs:</h3> &nbsp; <h2 id='nbConsoles'><?php echo nombreDispositif($db)?></h2></div>
                                <div class = "testsRealises"><h3> Total des tests réalisés:</h3> &nbsp; <h2 id='nbTests'><?php echo nombreTestsRealises($db)?></h2></div>
                            </div>
                            <div class="statistiques"><h3>Statistiques</h3>
                                <canvas id="graphStats" width="1000" height="250"> </canvas>
                            </div>
                        </div>
                    </div>
                    <div id="1" class="choix" style="display: none;">
                        <table id="adminDispositif">
                            <tr >
                                <td class="titre"> <h1> Dispositifs </h1> </td>
                                <td class="recherche" > <input type="search" id="admin-search-dispositif" name="adminSearchDispositif" aria-label="Search through site content" placeholder="Recherche" ><button class="adminSearchDispositif" onclick="rechercheDispositif()"> Rechercher </button>  </td>
                            </tr>
                            <tr>
                                <td>
                                    <button class="buttonAddDispositif" onclick="openAddDispositif()"> <img src="images/iconAddDispositif.png"/> Ajouter un dispositif </button>
                                    <div class="addDispositif">
                                        <img src="images/iconAddDispositif.png" style="height: 16.5pt;"/>
                                        <textarea id="addCode" name="code" cols="17" rows="1" placeholder="Code (6 chiffres)"></textarea>
                                        <select id="addDispositif" size="1">
                                            <?php echo listeManager($db) ?>
                                        </select>
                                        <img src="images/iconValider.png" onclick="validateAddDispositif(0, '')" />
                                        <img src="images/iconAnnuler.png" onclick="closeAddDispositif(0, '')"/>
                                    </div>
                                </td>
                                <td> <select id="selectDispositif" size="1">
                                    <option value="0" > Croissant </option>
                                    <option value="1"> Décroissant</option>
                                    <option value="2"> Médecin</option>
                                    <option value="3"> Adresse </option>
                                </select> </td>
                            </tr>
                        </table>
                        <div id="listeInfoDispositif"><?php echo listeInfoDispositif($db, 0, ''); ?></div>
                    </div>
                    <div id="2" class="choix" style="display: none;">
                        <table id="adminUtilisateur">
                            <tr>
                                <td class="titre" > <h1> Utilisateurs </h1> </td>
                                <td class="recherche" > <input type="search" id="admin-search-utilisateur" name="adminSearchUtilisateur" aria-label="Search through site content" placeholder="Recherche" ><button class="adminSearchUtilisateur" onclick="rechercheUtilisateur()"> Rechercher </button>  </td>
                            </tr>
                            <tr>
                                <td><a href='inscription.php' style="color: black;"><img src="images/iconAjouterUser.png" /> Ajouter un utilisateur </a> &nbsp; <button class="openRequêtes" onclick="openRequetes()" style="display: inherit;"> Requêtes en attentes <img src="images/iconOuvrir.png"/></button> </td>
                                <td> <select id="selectUtilisateur" size="1">
                                    <option value="0"> Croissant </option>
                                    <option value="1"> Décroissant </option>
                                    <option value="2"> Type de compte</option>
                                    <option value="3"> Nom</option>
                                    <option value="4"> Prenom</option>
                                </select> </td>
                            </tr>
                        </table>
                        <div id="listeInfoUtilisateur"><?php echo listeInfoUtilisateur($db, 0, '')?></div>
                    </div>
                    <div id="3" class="choix" style="display: none;">
                        <div id="adminFAQ">
                            <h1> FAQ </h1>
                            <button class="ajouterQuestion" onclick="ajouterQuestion()"> Ajouter question </button>
                        </div>
                        <div class="listeQuestionsAdmin"><?php echo listeFAQ($db)?></div>
                    </div>
                </div>
            </section>
        </main>
    </body>
</html>
<?php
$freq=0;
$temp=0;
$tona=0;
$stim=0;
$colo=0;
$test=testInfo($db);
for ($i=0; $i<count($test); $i++){
    if ($test[$i]['type']=='freq'){
        $freq=$test[$i]['nb'];
    }elseif ($test[$i]['type']=='temp'){
        $temp=$test[$i]['nb'];
    }elseif ($test[$i]['type']=='tona'){
        $tona=$test[$i]['nb'];
    }elseif ($test[$i]['type']=='stim'){
        $stim=$test[$i]['nb'];
    }elseif ($test[$i]['type']=='colo'){
        $colo=$test[$i]['nb'];
    }
}
$datas="[" .$freq ."," .$temp ."," .$tona ."," .$stim ."," .$colo ."]";
$labels="['Fréquence cardiaque','Température','Reconnaissance de tonalités', 'Réaction à des stimuli visuels','Mémorisation de couleurs']";
?>
<script LANGUAGE='JavaScript'>
    var hauteur=document.getElementsByClassName("statistiques")[0].offsetWidth;
    hauteur=0.95*hauteur
    graphe(<?php echo $datas; ?>,<?php echo $labels; ?>, hauteur);
</script>