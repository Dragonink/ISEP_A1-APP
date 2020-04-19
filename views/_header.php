<header>
    <a href="index.php"><img src="images/infinite_measures.jpg" height="64"/></a>
    <a href="#qsn">Qui sommes-nous ?</a>
    <a href="#ntp">Notre projet</a>
    <a href="#contact">Contact</a>
    <?php
    
        if (isset($_SESSION["user_type"]) && isset($_SESSION["user_id"])) {
            echo "<div>",
                "<div id='account'>",
                $_SESSION["user_prenom"] . " " . $_SESSION["user_nom"],
                "<img src='images/iconProfil.jpg' height='64'/>",
                "</div>",
                "<ul id='dropdown'>";
            if ($_SESSION["user_type"]=='user'){
                echo "<li><a href='utilisateur.php'>Mon profil</a></li>",
                    "<li><a href='modifUtilisateur.php'>Modifier mon profil</a></li>";
            }elseif ($_SESSION["user_type"]=='manager'){
                echo "<li><a href='gestionnaire.php'>Mon profil</a></li>",
                    "<li><a href='modifGestionnaire.php'>Modifier mon profil</a></li>";
            }elseif ($_SESSION["user_type"]=='administrator'){
                echo "<li><a href='admin.php'>Mon profil</a></li>",
                    "<li><a href='modifAdmin.php'>Modifier mon profil</a></li>";
            }
            echo "<li><a href='deconnexion.php'>Déconnexion</a></li>",
                "</ul>",
                "</div>";
        } else echo "<ul id='sign'>",
            "<li><a href='connexion.php'>Connexion</a></li>",
            "|",
            "<li><a href='inscription.php'>Inscription</a></li>",
            "</ul>";
    ?>
</header>
