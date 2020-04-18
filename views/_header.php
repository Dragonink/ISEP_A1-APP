<header>
    <a href="index.php"><img src="images/infinite_measures.jpg" height="64"/></a>
    <a href="#qsn">Qui sommes-nous ?</a>
    <a href="#ntp">Notre projet</a>
    <a href="#contact">Contact</a>
    <?php
        if (isset($_SESSION["user_type"]) && isset($_SESSION["user_id"])) {
            require "../models/account_info.php";
            switch ($_SESSION["user_type"]) {
                case "user":
                    $user_info = fetchUser($_SESSION["user_id"]);
                    break;
                case "manager":
                    $user_info = fetchManager($_SESSION["user_id"]);
                    break;
                case "administrator":
                    $user_info = fetchAdmin($_SESSION["user_id"]);
                    break;
            }
            echo "<div>",
                "<div id='account'>",
                $user_info["first_name"] . " " . $user_info["last_name"],
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
