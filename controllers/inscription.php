<?php
session_start();
require "../models/connexionSQL.php";
$type = $firstname = $lastname = $email = $password = $nss = $linked_manager = $address = "";
function trim_input($data) {
	return htmlspecialchars(stripslashes(trim($data)));
}
$type = trim_input($_POST["type"]);
$firstname = trim_input($_POST["firstname"]);
$lastname = trim_input($_POST["lastname"]);
$email = trim_input($_POST["email"]);
$nss = trim_input($_POST["nss"]);
$linked_manager = trim_input($_POST["linked-manager"]);
$address = trim_input($_POST["address"]);

function error() {
    echo "<script>alert(", "Une erreur est survenue.", ");</script>";
    exit;
}
switch ($type) {
    case "user":
        $status = $db->prepare("INSERT INTO user(nss, first_name, last_name, email, manager) VALUES ($nss, $firstname, $lastname, $email, ?, $linked_manager)")->execute([password_hash($password)]);
        if ($status) {
            $_SESSION["user_type"] = "user";
            $_SESSION["user_id"] = $nss;
            header("Location: utilisateur.php", true, 303);
            exit;
        } else error();
        break;
    case "manager":
        $status = $db->prepare("INSERT INTO manager(first_name, last_name, email, password, work_address) VALUES ($firstname, $lastname, $email, ?, $address)")->execute([password_hash($password)]);
        if ($status) {
            $_SESSION["user_type"] = "manager";
            $_SESSION["user_id"] = $email;
            header("Location: gestionnaire.php", true, 303);
            exit;
        } else error();
        break;
    case "administrator":
        $status = $db->prepare("INSERT INTO administrator(first_name, last_name, email, password) VALUES ($firstname, $lastname, $email, ?)")->execute([password_hash($password)]);
        if ($status) {
            $_SESSION["user_type"] = "administrator";
            $_SESSION["user_id"] = $email;
            header("Location: admin.php", true, 303);
            exit;
        } else error();
        break;
}
