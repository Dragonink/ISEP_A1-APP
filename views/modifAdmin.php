<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <!-- JS -->
    <script src="js/code.js"></script>
    <script src="js/admin.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

    <!-- CSS -->
    <link href="css/admin.css" rel="stylesheet" type="text/css">
    <link href="css/header-footer.css" rel="stylesheet" type="text/css">

</head>

<body>
    <?php require "_header.php"; ?>
    <section id="contenuAdmin">
        <form class="modificationProfil" method="POST" action ="routeur.php">
            <h2>Modification profil</h2></br>
            <table>
                <tr>
                    <td>
                        <p>Nom</p>
                    </td>
                    <td><input type="text" name="nom" placeholder="Nom" /></td>
                </tr>
                <tr>
                    <td>
                        <p>Prénom</p>
                    </td>
                    <td><input type="text" name="prenom" placeholder="Prénom" /></td>
                </tr>
                <tr>
                    <td>
                        <p>E-mail</p>
                    </td>
                    <td><input type="email" name="email" placeholder="prenom.nom@infinitesMeasures.com" /></td>
                </tr>
                <tr>
                    <td>
                        <p>Vérification e-mail</p>
                    </td>
                    <td><input type="email" name="verifemail" /></td>
                </tr>
                <tr>
                    <td>
                        <p>Mot de passe</p>
                    </td>
                    <td><input type="text" name="mdp" /></td>
                </tr>
                <tr>
                    <td>
                        <p>Vérification mot de passe</p>
                    </td>
                    <td><input type="text" name="verifmdp" /></td>
                </tr>
            </table>
            <div class="boutons">
                <button id="annuler"> Annuler </button>
                <button id="valider" name="modifAdmin"> Valider </button>
            </div>
        </form>
    </section>
</body>

</html>