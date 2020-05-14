<?php
require "../models/requeteTests.php";
$tests = array("freq" => null, "temp" => null, "tona" => null, "stim" => null, "colo" => null);
function trim_input($data) {
	return htmlspecialchars(stripslashes(trim($data)));
}
if (isset($_POST["freq"])) {
    $tests["freq"] = trim_input($_POST["freq"]);
}
if (isset($_POST["temp"])) {
    $tests["temp"] = trim_input($_POST["temp"]);
}
if (isset($_POST["tona"])) {
    $tests["tona"] = trim_input($_POST["tona"]);
}
if (isset($_POST["stim"])) {
    $tests["stim"] = trim_input($_POST["stim"]);
}
if (isset($_POST["colo"])) {
    $tests["colo"] = trim_input($_POST["colo"]);
}

saveTests($db, $_SESSION["exam_id"], $tests);
unset($_SESSION["exam_id"]);
header("Location: utilisateur.php", true, 303);
exit;
