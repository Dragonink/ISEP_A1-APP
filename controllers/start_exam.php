<?php
session_start();
require "../models/requeteTests.php";
$tests = $console = "";
function trim_input($data) {
	return htmlspecialchars(stripslashes(trim($data)));
}
$_SESSION["exam_tests"] = trim_input($_POST["tests"]);
$_SESSION["exam_console"] = trim_input($_POST["console"]);

saveConsole($db, $_SESSION["exam_id"], $_SESSION["exam_console"]);
header("Location: tests.php", true, 303);
exit;
