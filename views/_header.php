<header>
    <a href="index.php"><img src="images/infinite_measures.jpg" height="64"/></a>
    <a href="#qsn">Qui sommes-nous ?</a>
    <a href="#ntp">Notre projet</a>
    <a href="#contact">Contact</a>
    <?php
        if (isset($_SESSION["user_type"]) && isset($_SESSION["user_id"])) {
            require "models/connexionSQL.php";
            $user_info = $db->query("SELECT first_name, last_name, picture FROM " . $_SESSION["user_type"] . " WHERE id = " .$_SESSION["user_id"])->fetch(PDO::FETCH_ASSOC);
            echo "<div>",
                "<div id='account'>",
                $user_info["first_name"] . " " . $user_info["last_name"],
                //"<p>Sample User</p>",
                "<img src='images/iconProfil.jpg' height='64'/>",
                "</div>",
                "<ul id='dropdown'>",
                "<li><a href=''>Mon profil</a></li>",
                "<li><a href=''>Modifier mon profil</a></li>",
                "<li><a href='deconnexion.php'>Déconnexion</a></li>",
                "</ul>",
                "</div>";
        } else echo "<ul id='sign'>",
            "<li><a href='connexion.html'>Connexion</a></li>",
            "|",
            "<li><a href='inscription.html'>Inscription</a></li>",
            "</ul>";
    ?>
</header>
