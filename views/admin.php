<?php
    include('../controllers/adminDonnees.php');
?>

<!DOCTYPE html>
<meta charset="UTF-8">
<html>
    <head>

        <!-- JS -->
        <script src="js/code.js"></script>
        <script src="js/admin.js"></script>
        <script src ="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

        <!-- CSS -->
        <link href="css/admin.css" rel="stylesheet" type="text/css">
        <link href="css/style.css" rel="stylesheet" type="text/css">

    </head>

    <body>
        <header id="navHeader"></header>
        <section id="contenuAdmin">
            <div class="requetes" style="display: none;">
                <div class="content">
                    <div id="menuRequetes">
                        <button class= "demande actif" onclick="openRequete(0)"> Toutes les demandes (<?php echo nombreRequete($db) ?>) </button>
                        <button class= "demande" onclick="openRequete(1)"><img src="images/iconSecurite.png"> Demandes administrateur (<?php echo nombreRequeteAdmin($db) ?>) </button>
                        <button class= "demande" onclick="openRequete(2)"><img src="images/iconDispositif.png"> Demandes médecins (<?php echo nombreRequeteManager($db) ?>) </button>
                    </div>
                    <div id="affichageRequetes">
                        <button class="close" onclick="closeRequetes()"><img src="images/iconCroix.png"></button>
                        <div id="requete"><?php echo listeInfoRequete($db, 0) ?></div>
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
                            <div class = "visites"><h3>Total des utilisateurs:</h3> &nbsp; <h2><?php echo nombreUtilisateur($db) ?></h2></div>
                            <div class = "testsRealises"><h3> Total des tests réalisés:</h3> &nbsp; <h2><?php echo nombreTestsRealises($db)?></h2></div>
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
                                    <textarea id="addProprietaire" name="proprietaire" cols="15" rows="1" placeholder="Nom propriétaire"></textarea>
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
                    <?php echo listeInfoDispositif($db, 0, '')?>
                </div>
                <div id="2" class="choix" style="display: none;">
                    <table id="adminUtilisateur">
                        <tr>
                            <td class="titre" > <h1> Utilisateurs </h1> </td>
                            <td class="recherche" > <input type="search" id="admin-search-utilisateur" name="adminSearchUtilisateur" aria-label="Search through site content" placeholder="Recherche" > </td>
                        </tr>
                        <tr>
                            <td><a href='inscription.html' style="color: black;"><img src="images/iconAjouterUser.png" /> Ajouter un utilisateur </a> &nbsp; <button class="openRequêtes" onclick="openRequetes()" style="display: inherit;"> Requêtes en attentes <img src="images/iconOuvrir.png"/></button> </td>
                            <td> <select size="1">
                                <option value disabled selected > Trier par: </option>
                                <option value="1"> Option 1 </option>
                                <option value="2"> Option 2 </option>
                            </select> </td>
                        </tr>
                    </table>
                    <?php echo listeInfoUtilisateur($db, 0, '')?>
                </div>
                <div id="4" class="choix" style="display: none;">
                    <div id="adminFAQ">
                        <h1> FAQ </h1>
                        <button class="ajouterQuestion"> Ajouter question </button>
                    </div>
                    <table class="listeQuestionsAdmin">
                        <tr class="question" id="1" style="display:table-row;">
                            <td style="width: 5%;"> 1. </td>
                            <td style="width: 15%;"> Question 1 </td>
                            <td style="width: 5%;"> <img src="images/iconDroite.png" class='symboleDroite actif' onclick="openReponse(1)"/> </td>
                            <td class="vide" style="font-size: 15px;"> Dernière modification par Prenom Nom </td>
                            <td style="width: 5%;">
                                <img src="images/iconModifier.png" class='symboleModifier' onclick="openModification(1)"/>
                                <img src="images/iconCroix.png"/>
                            </td>
                        </tr>
                        <tr class="affichage" id="1" style='display:none;'>
                            <td style="width: 5%;"> 1. </td>
                            <td style="width: 15%;"> Question 1 </td>
                            <td style="width: 5%;"> <img src="images/iconBas.png" class='symboleBas' onclick="closeReponse(1)"/> </td>
                            <td class="vide" style="font-size: 15px;"> Dernière modification par Prenom Nom  </td>
                            <td style="width: 5%;">
                                <img src="images/iconModifier.png" class='symboleModifier' onclick="openModification(1)"/>
                                <img src="images/iconCroix.png"/>
                            </td>
                        </tr>
                        <tr class="reponse" id="1" style='display:none;'>
                            <td> </td>
                            <td colspan="3" id="reponse"> Blablabla </td>
                        </tr>
                        <tr class="modifier" id="1" style='display:none;'>
                            <td style="width: 5%;"> 1. </td>
                            <td style="width: 15%;"> <textarea id="answer" name="question 1" cols="20" rows="1" style="resize: none;"> Question 1 </textarea> </td>
                            <td class="vide" colspan="2"> </td>
                            <td style="width: 5%;">
                                <img src="images/iconValider.png"/>
                                <img src="images/iconAnnuler.png" class='symboleAnnuler' onclick="openReponse(1)"/>
                            </td>
                        </tr>
                        <tr class="reponseModifiable" id="1" style='display:none;'>
                            <td> </td>
                            <td colspan="3" id="reponse">
                                <textarea id="answer" name="question 1" cols="140" rows="8" style="resize: none;"> Blablabla </textarea>
                            </td>
                        </tr>
                        <tr class="question" id="2" style="display:table-row;">
                            <td style="width: 5%;"> 2. </td>
                            <td style="width: 15%;"> Question 2 </td>
                            <td style="width: 5%;"> <img src="images/iconDroite.png" class='symboleDroite actif' onclick="openReponse(2)"/> </td>
                            <td class="vide" style="font-size: 15px;"> Dernière modification par Prenom Nom  </td>
                            <td style="width: 5%;">
                                <img src="images/iconModifier.png" class='symboleModifier' onclick="openModification(2)"/>
                                <img src="images/iconCroix.png"/>
                            </td>
                        </tr>
                        <tr class="affichage" id="2" style='display:none;'>
                            <td style="width: 5%;"> 2. </td>
                            <td style="width: 15%;"> Question 2 </td>
                            <td style="width: 5%;"> <img src="images/iconBas.png" class='symboleBas' onclick="closeReponse(2)"/> </td>
                            <td class="vide" style="font-size: 15px;"> Dernière modification par Prenom Nom  </td>
                            <td style="width: 5%;">
                                <img src="images/iconModifier.png" class='symboleModifier' onclick="openModification(2)"/>
                                <img src="images/iconCroix.png"/>
                            </td>
                        </tr>
                        <tr class="reponse" id="2" style='display:none;'>
                            <td> </td>
                            <td colspan="3" id="reponse"> Blablabla </td>
                        </tr>
                        <tr class="modifier" id="2" style='display:none;'>
                            <td style="width: 5%;"> 2. </td>
                            <td style="width: 15%;"> <textarea id="answer" name="question 2" cols="20" rows="1" style="resize: none;"> Question 2 </textarea> </td>
                            <td class="vide" colspan="2"> </td>
                            <td style="width: 5%;">
                                <img src="images/iconValider.png"/>
                                <img src="images/iconAnnuler.png" class='symboleAnnuler' onclick="openReponse(2)"/>
                            </td>
                        </tr>
                        <tr class="reponseModifiable" id="2" style='display:none;'>
                            <td> </td>
                            <td colspan="3" id="reponse">
                                <textarea id="answer" name="question 2" cols="140" rows="8" style="resize: none;"> Blablabla </textarea>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>
    </body>
    <script LANGUAGE='JavaScript'>
        header();
        graphe(); 
    </script>
</html>