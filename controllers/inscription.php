<?php
session_start();
require "../models/account_info.php";
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
        $status = insertUser($nss, $firstname, $lastname, $email, $password, $linked_manager);
        if ($status) {
            $_SESSION["user_type"] = "user";
            $_SESSION["user_id"] = $nss;
            header("Location: utilisateur.php", true, 303);
            exit;
        } else error();
        break;
    case "manager":
        $status = insertManager($firstname, $lastname, $email, $password, $address);
        if ($status) {
            $_SESSION["user_type"] = "manager";
            $_SESSION["user_id"] = getManagerId($email);
            header("Location: gestionnaire.php", true, 303);
            exit;
        } else error();
        break;
    case "administrator":
        $status = insertAdmin($firstname, $lastname, $email, $password);
        if ($status) {
            $_SESSION["user_type"] = "administrator";
            $_SESSION["user_id"] = getAdminId($email);
            header("Location: admin.php", true, 303);
            exit;
        } else error();
        break;
}
