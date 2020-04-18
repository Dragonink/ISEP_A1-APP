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

        <section>
            <img id="logo" src="../images/Infinite_measures.png"/>
            <h1>Infinite Measures</h1>
        </section>

        <section id="qsn">
            <div>
                <h2>Qui sommes-nous ?</h2>
                Vendeur de systèmes de mesures psychotechniques pour la formation et l'évaluation de conducteurs et pilotes.<br/>
                Pour vous:<ul>
                    <li>Autoécoles, à destination finale des conducteurs ayant eu leurs permis annulés</li>
                    <li>Centres de formation de conducteurs de trains ou d'engins de chantiers</li>
                    <li>Centres médicaux pour les vérifications des pilotes d'engins volants</li>
                    <li>Centres de recherches scientifiques pour des analyses comportementales</li>
                </ul>
            </div>
            <img src="images/Qui_sommes_nous.png" />
        </section>

        <section id="ntp">
            <img src="images/Projet.png" />
            <div>
                <h2>Notre projet</h2>
                Une machine effectuant 5 tests psychotechniques:<ol>
                    <li>Fréquence cardiaque</li>
                    <li>Température</li>
                    <li>Reconnaissance de tonalités</li>
                    <li>Réaction à des stimuli visuels</li>
                    <li>Mémorisation de couleurs</li>
                </ol>
            </div>
        </section>
        <section id="contact">
            <form>
                <h2>Contact</h2>
                <input name="email" type="email" placeholder="Votre adresse Email" required />
                <input name="subject" placeholder="Objet" required />
                <textarea name="content" placeholder="Message" required></textarea>
                <button type="submit">Envoyer</button>
            </form>
            <div>
                <h2>Nous trouver</h2>
                <img src="images/map.png" />
        </section>
    </main>

    <?php include "_footer.html"; ?>

</body>

</html>
