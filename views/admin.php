<?php
    include('../controllers/adminDonnees.php');

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <!-- JS -->
        <script src="js/code.js"></script>
        <script src="js/admin.js"></script>
        <script src ="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

        <!-- CSS -->
        <link rel="stylesheet" href="css/header-footer.css"/>
        <link href="css/admin.css" rel="stylesheet" type="text/css">

    </head>

    <body>
        <?php require "_header.php"; ?>
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
                        <div id="requete" class="requete"><?php echo listeInfoRequete($db, 0) ?></div>
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
                            <div class = "testsRealises"><h3> Total des tests réalisés:</h3> &nbsp; <h2 id='nbUtilisateur'><?php echo nombreTestsRealises($db)?></h2></div>
                        </div>
                        <div class="statistiques"><h3>Statistiques</h3>
                            <canvas id="graphStats" width="400" height="90"> </canvas>
                        </div>
                    </div>
                </div>
                <div id="1" class="choix" style="display: none;">
                    <table id="adminDispositif">
                        <tr >
                            <td class="titre"> <h1> Dispositifs </h1> </td>
                            <td class="recherche" ><input type="search" id="admin-search-dispositif" name="adminSearchDispositif" aria-label="Search through site content" placeholder="Recherche" style="width: 100%;"> </td>
                        </tr>
                        <tr>
                            <td>
                                <button class="buttonAddDispositif" onclick="openAddDispositif()"> <img src="images/iconAddDispositif.png"/> Ajouter un dispositif </button>
                                <div class="addDispositif">
                                    <img src="images/iconAddDispositif.png" style="height: 16.5pt;"/>
                                    <textarea id="addCode" name="code" cols="15" rows="1" placeholder="Code"></textarea>
                                    <select id="addDispositif" size="1">
                                        <?php echo listeManager($db, 0, '') ?>
                                    </select>
                                    <img src="images/iconValider.png" onclick="validateAddDispositif()" />
                                    <img src="images/iconAnnuler.png" onclick="closeAddDispositif()"/>
                                </div>
                            </td>
                            <td> <select size="1">
                                <option value disabled selected > Trier par: </option>
                                <option value="1"> Option 1 </option>
                                <option value="2"> Option 2 </option>
                            </select> </td>
                        </tr>
                    </table>
                    <div id="listeInfoDispositif"><?php echo listeInfoDispositif($db, 0, '')?></div>
                </div>
                <div id="2" class="choix" style="display: none;">
                    <table id="adminUtilisateur">
                        <tr>
                            <td class="titre" > <h1> Utilisateurs </h1> </td>
                            <td class="recherche" > <input type="search" id="admin-search-utilisateur" name="adminSearchUtilisateur" aria-label="Search through site content" placeholder="Recherche" > </td>
                        </tr>
                        <tr>
                            <!--<td><a href='inscription.html' style="color: black;"><img src="images/iconAjouterUser.png" /> Ajouter un utilisateur </a> &nbsp; <button class="openRequêtes" onclick="openRequetes()" style="display: inherit;"> Requêtes en attentes <img src="images/iconOuvrir.png"/></button> </td>-->
                            <td><button onclick="ajout()"><img src="images/iconAjouterUser.png" /> Ajouter un utilisateur </button> &nbsp; <button class="openRequêtes" onclick="openRequetes()" style="display: inherit;"> Requêtes en attentes <img src="images/iconOuvrir.png"/></button> </td>
                            <td> <select size="1">
                                <option value="0"> Trier par: </option>
                                <option value="1"> Option 1 </option>
                                <option value="2"> Option 2 </option>
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
    </body>
    <script LANGUAGE='JavaScript'>
        graphe();
    </script>
</html>
