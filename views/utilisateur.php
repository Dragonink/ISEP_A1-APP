<?php
session_start();
require "../models/account_info.php";
$manager_info = fetchManager2($db, $_SESSION["user_medecin"]);
$manager_info = $manager_info[0];
require "../models/requeteTests.php";
$exam = getExamId($db, $_SESSION["user_id"]);
if (count($exam) > 0) {
    $tests = getTests($db, $exam);
}
?><!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <!-- JS -->
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
                    <div><?php echo $_SESSION["user_prenom"] ?></div> &nbsp; <div><?php echo $_SESSION["user_nom"] ?></div>
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
                <div>E-mail: <?php echo $_SESSION["user_email"] ?></div>
                <div>Numéro de sécurité sociale: <?php echo $_SESSION["user_id"]; ?></div>
                <div>Numéro de téléphone: <?php
                    if ($_SESSION["user_tel"] === NULL){
                        echo "N/A";
                    } else {
                        echo $_SESSION["user_prenom"] ;
                    }
                ?></div>
                <div>Médecin: <?php
                    if ($_SESSION["user_medecin"] === NULL) {
                        echo "ERREUR";
                    } else {
                        echo $manager_info["first_name"], " ", $manager_info["last_name"];
                    }
                ?></div>
            </td>
            <td class="resultatDernierTest">
                <canvas id="resultatDernierTestGraph"> </canvas>
                <?php if (sizeof($tests) > 0) {
                    echo "<form method='POST' action='../controllers/start_exam.php'>",
                        "<input type='number' name='tests' value='" . implode(" ", $tests) . "' hidden required />",
                        "<label for='console'>ID console</label>",
                        "<input type='text' name='console' placeholder='ID console' required />",
                        "<button type='submit'>Effectuer Test</button>",
                        "</form>";
                } ?>
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
