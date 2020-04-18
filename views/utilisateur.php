<?php
session_start();
require "../models/account_info.php";
$user_info = fetchUser($_SESSION["user_id"]);
if ($user_info === FALSE) {
    echo "<script>alert(", "Une erreur est survenue.", ");</script>";
    exit;
}
$manager_info = fetchManager($user_info["manager"]);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <!-- JS -->
    <script src="js/code.js"></script>
    <script src="js/profil.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

    <!-- CSS -->
    <link href="css/profil.css" rel="stylesheet" type="text/css">
    <link href="css/header-footer.css" rel="stylesheet" type="text/css">

</head>

<body>
    <?php require "_header.php"; ?>

    <table class="infoProfil">
        <tr>
            <td class="donneesPersonnelles">
                <div>
                    <img src="images/iconProfil.jpg" />
                    <div><?php echo $user_info["first_name"]; ?></div> &nbsp; <div><?php echo $user_info["last_name"]; ?></div>
                </div>
                <div>Sexe: <?php
                    switch (substr($_SESSION["user_id"], 0, 1)) {
                        case "1":
                            echo "Homme";
                            break;
                        case "2":
                            echo "Femme";
                            break;
                    }
                ?></div>
                <div> Date de naissance: <?php echo substr($_SESSION["user_id"],3,2), "/", substr($_SESSION["user_id"], 1, 2); ?></div>
                <div>E-mail: <?php echo $user_info["email"]; ?></div>
                <div>Numéro de sécurité sociale: <?php echo $_SESSION["user_id"]; ?></div>
                <div>Numéro de téléphone: <?php
                    if ($user_info["phone"] === NULL) echo "N/A";
                    else echo $user_info["phone"];
                ?></div>
                <div>Médecin: <?php
                    if ($manager_info === FALSE) echo "ERREUR";
                    else echo $manager_info["first_name"], " ", $manager_info["last_name"];
                ?></div>
            </td>
            <td class="resultatDernierTest">
                <canvas id="resultatDernierTestGraph"> </canvas>
                <div class="démarrerTest" style="display: none;">
                    <form>
                        id passerelle &nbsp; <input type="text" name="idPasserelle" placeholder="idPasserelle" />
                        <input type="button" value="Effetuer Test" onclick="demarrerTest()">
                    </form>
                </div>
            </td>
        </tr>
    </table>
    <hr>
    <table class="resultatTest">
        <tr>
            <td class="titre"> Résultats des tests </td>
            <td class="choix">
                <select id="choix" size="1" onchange="resultatTest()">
                    <option value="0" selected> Tout les test </option>
                    <option value="1"> Test 1 </option>
                    <option value="2"> Test 2 </option>
                    <option value="3"> Test 3 </option>
                    <option value="4"> Test 4 </option>
                    <option value="5"> Test 5 </option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="test">
                <canvas id="resultatTestGraph" width="400" height="180"></canvas>
            </td>
        </tr>
    </table>

    <?php require "_footer.html"; ?>
</body>
<script type='text/javascript'>
    dernierTest();
    resultatTest();
</script>

</html>
