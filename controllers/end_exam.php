<?php
session_start();
require "../models/requeteTests.php";
$freq = $temp = $tona = $stim = $colo = "";
$tests = [];
function trim_input($data) {
	return htmlspecialchars(stripslashes(trim($data)));
}
if (isset($_POST["freq"])) {
    $freq = trim_input($_POST["freq"]);
    array_merge($tests, ["freq" => $freq]);
}
if (isset($_POST["temp"])) {
    $temp = trim_input($_POST["temp"]);
    array_merge($tests, ["temp" => $temp]);
}
if (isset($_POST["tona"])) {
    $tona = trim_input($_POST["tona"]);
    array_merge($tests, ["tona" => $tona]);
}
if (isset($_POST["stim"])) {
    $stim = trim_input($_POST["stim"]);
    array_merge($tests, ["stim" => $stim]);
}
if (isset($_POST["colo"])) {
    $colo = trim_input($_POST["colo"]);
    array_merge($tests, ["colo" => $colo]);
}

saveTests($db, $_SESSION["exam_id"], $tests);
unset($_SESSION["exam_id"]);
header("Location: utilisateur.php", true, 303);
exit;
