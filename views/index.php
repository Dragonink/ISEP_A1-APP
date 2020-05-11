<?php session_start(); 
if (isset($_GET['validation']) && $_GET['validation']=='medecin'){
    echo "<script>alert(\"Votre demande a été prise en compte et sera traitée dans les meilleurs délais.\")</script>";
} elseif (isset($_GET['validation']) && $_GET['validation']=='admin') {
    echo "<script>alert(\"Votre demande a été prise en compte et sera traitée dans les meilleurs délais.\")</script>";
}
?>
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
            <img id="qsn_img" src="images/Qui_sommes_nous.png" />
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
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2546.0976138211868!2d2.2799196659319434!3d48.82452595810421!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e670797ea4730d%3A0xe0d3eb2ad501cb27!2sISEP!5e0!3m2!1sfr!2sfr!4v1588842549578!5m2!1sfr!2sfr" width="400" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>        
        </section>
    </main>

    <?php include "_footer.html"; ?>

</body>

</html>
