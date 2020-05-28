<?php
require "../models/requeteTests.php";
$tests = array("freq" => null, "temp" => null, "tona" => null, "stim" => null, "colo" => null);
function trim_input($data) {
	return htmlspecialchars(stripslashes(trim($data)));
}
if (isset($_POST["freq"])) {
    $tests["freq"] = trim_input($_POST["freq"]);
    if ($tests["freq"] < 40 || $tests["freq"] > 140) {
        setcookie("testError", "fréquence cardiaque");
        header("Location: tests.php", true, 303);
        exit;
    }
}
if (isset($_POST["temp"])) {
    $tests["temp"] = trim_input($_POST["temp"]);
    if ($tests["temp"] < 20 || $tests["temp"] > 40) {
        setcookie("testError", "température");
        header("Location: tests.php", true, 303);
        exit;
    }
}
if (isset($_POST["tona"])) {
    $tests["tona"] = trim_input($_POST["tona"]);
    if ($tests["tona"] < 130 || $tests["tona"] > 4000) {
        setcookie("testError", "reconnaissance de tonalités");
        header("Location: tests.php", true, 303);
        exit;
    }
}
if (isset($_POST["stim"])) {
    $tests["stim"] = trim_input($_POST["stim"]);
    if ($tests["stim"] < 0 || $tests["stim"] > 5) {
        setcookie("testError", "réaction à des stimuli visuels");
        header("Location: tests.php", true, 303);
        exit;
    }
}
if (isset($_POST["colo"])) {
    $tests["colo"] = trim_input($_POST["colo"]);
    if ($tests["colo"] < 0 || $tests["colo"] > 20) {
        setcookie("testError", "mémorisation de couleurs");
        header("Location: tests.php", true, 303);
        exit;
    }
}

saveTests($db, $_SESSION["exam_id"], $tests);
unset($_SESSION["exam_id"]);
header("Location: utilisateur.php", true, 303);
exit;
