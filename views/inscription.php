<?php if ($_SERVER["REQUEST_METHOD"] === "POST") require "../controllers/inscription.php";
include('../controllers/adminDonnees.php');
?><!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Inscription</title>
    <link rel="stylesheet" type="text/css" href="css/sign.css" />
    <script type="text/javascript" src="js/signup.js"></script>
</head>

<body onload="selectType('user');">
    <header>
        <h1>INFINITE MEASURES</h1>
    </header>
    <main>

        <form id="signup" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" data-account="user">
            <div>
                <label for="type">Type de compte</label>
                <div>
                    <input id="user" type="radio" name="type" value="user" onclick="selectType('user');" checked />
                    <label for="user">Patient</label>
                </div>
                <div>
                    <input id="manager" type="radio" name="type" value="manager" onclick="selectType('manager');" />
                    <label for="manager">Médecin</label>
                </div>
                <div>
                    <input id="admin" type="radio" name="type" value="admin" onclick="selectType('admin');" />
                    <label for="admin">Administrateur</label>
                </div>
            </div>
            <div>
                <label for="firstname">Prénom</label>
                <input id="firstname" name="firstname" type="text" required />
                <label for="lastname">Nom</label>
                <input id="lastname" name="lastname" type="text" required />
                <label for="email">Adresse mail</label>
                <input id="email" name="email" type="email" required />
                <label for="password">Mot de passe</label>
                <input id="password" name="password" type="password" pattern=".{8,}" required title="8 caractères minimum" />
                <!-- User only -->
                <label for="nss" class="user">N° Sécurité Sociale</label>
                <input id="nss" class="user" name="nss" type="text" required />
                <label for="manager" class="user">Médecin</label>
                <select id="manager" class="user" name="manager" required>
                    <?php echo listeManager($db); ?>
                </select>
                <!-- Manager only -->
                <label for="address" class="manager">Adresse de travail</label>
                <input id="address" class="manager" name="address" type="text" required />
            </div>
            <input id="cgu" name="cgu" type="checkbox" required />
            <label for="cgu">J'accepte les <a href="cgu.php" target="_blank">Conditions Générales d'Utilisation</a></label>
            <button type="submit" name='inscription'>Inscription</button>
        </form>
        <div>
            <label for="signin">Vous avez déjà un compte ?</label>
            <a id="signin" href="connexion.php">Se connecter</a>
        </div>
    </main>
</body>

</html>
