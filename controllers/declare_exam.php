<?php
session_start();
require "../models/requeteTests.php";
$user = "";
function trim_input($data) {
	return htmlspecialchars(stripslashes(trim($data)));
}
$user = trim_input($_POST["user"]);

declareTests($db, $user, $_POST["tests"]);
?>
