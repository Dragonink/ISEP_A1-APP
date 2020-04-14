<header>
    <a href="index.php"><img src="images/infinite_measures.jpg" height="50"/></a>
    <ul>
        <li><a href="#qsn">Qui sommes-nous ?</a></li>
        <li><a href="#ntp">Notre projet</a></li>
        <li><a href="#contact">Contact</a></li>
    </ul>
    <div>
        <?php
            if (isset($_SESSION["user_type"]) && isset($_SESSION["user_id"])) {
                require "models/connexionSQL.php";
                $db->prepare("SELECT first_name, last_name, picture FROM ? WHERE id = ?")->execute([$_SESSION["user_type"], $_SESSION["user_id"]]);
                //TODO class ?
            } else echo "<ul>",
                "<li><a href='connexion.html'>Connexion</a></li>",
                "<li><a href='inscription.html'>Inscription</a></li>",
                "</ul>";
        ?>
    </div>
</header>
