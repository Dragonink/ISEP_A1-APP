<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8"/>
    <title>Infinite Measures</title>
    <link rel="stylesheet" href="css/header-footer.css"/>
    <link rel="stylesheet" href="css/index.css"/>

</head>

<body>

    <?php include "_header.php"; ?>

    <main>
        <section id="Page_image">
            <div class="image_bg"></div>
            <img id="Image" src="../images/Infinite_measures.png" width="20%" />
            <div id="InfiniteMeasures">
                <span>Infinite Measures</span>
            </div>
        </section>

        <section class="qui_sommes_nous">
            <div class="qsn_bg" id="qsn"></div>
            <div class="image_qsn"></div>
            <img id="Image1" src="../images/Qui_sommes_nous.png" width="20%" />
            <div id="qsn_titre">
                <span>Qui sommes-nous ?</span>
            </div>
            <div id="qsn_texte">
                <span>Vendeur de systèmes de mesure psychotechniques pour la <br />
                    formation et l’évaluation des compétences de conducteurs <br />
                    et pilotes <br />
                    Pour vous : <br />
                    - Autoécoles, à destination finale des conducteurs ayant <br />
                    eu leurs permis annulés, <br />
                    - Centres de formation de conducteurs de trains ou d’engins <br />
                    de chantier et de grutiers, <br />
                    - Centres médicaux pour les vérifications des capacités <br />
                    psychotechniques des pilotes d’engins volants, <br />
                    - Des centres de recherche scientifique pour des analyses <br />
                    comportementales statistiques.
                </span>
            </div>

        </section>

        <section id="Notre_Projet">
            <div class="ntp_bg" id="ntp"></div>
            <div class="image_ntp"></div>
            <img id="Image2" src="../images/Projet.png" width="40%" />
            <div id="ntp_titre">
                <span>Notre projet</span>
            </div>
            <div id="ntp_texte">
                <span>Vérifications des capacités psychotechniques <br />
                    Une machine cinq tests <br />
                    <br />
                    1. Mesure de la fréquence cardiaque <br />
                    2. Mesure de la température <br />
                    3. Mesure de la qualité de reconnaissance de tonalités </br>
                    4. Mesure de la réaction à des stimulus visuels <br />
                    5. Evaluation de la capacité de mémorisation de couleurs
                </span>
            </div>
        </section>
        <section id="contact_map">
            <div class="contact_bg" id="contact"></div>
            <div id="Contact">
                <span>Contact</span>
            </div>
            <div id="Ou_nous_trouver">
                <span>Où nous trouver</span>
            </div>
            <div id="Adresse">
                <span>Adresse</span>
            </div>
            <!--img id="Carte" src="../images/map.png" height="536" width="777"/-->
            <div class="map"></div>
            <div class="contact_texte"></div>
            <form action="" method="get" class="contact">
                <div class="email_rect">
                    <label for="email_rect">E-mail</label>
                    <input type="text" name="email" id="email" required>
                </div>
                <div class="objet_rect">
                    <label for="objet">Objet</label>
                    <input type="objet" name="objet" id="objet" required>
                </div>
                <div class="contact_texte">
                    <label for="contact_texte">Message</label>
                    <textarea type="string" name="message" id="message" cols="40" rows="13" required></textarea>
                </div>
                <input class="Envoyer" type="submit" value="Envoyer">
            </form>
        </section>
    </main>

    <?php include "_footer.html"; ?>

</body>

</html>
