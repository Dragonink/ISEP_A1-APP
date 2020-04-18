<?php
session_start();
require "../models/account_info.php";
$account = $passwd = "";
function trim_input($data) {
	return htmlspecialchars(stripslashes(trim($data)));
}
$account = trim_input($_POST["account"]);
$passwd = trim_input($_POST["password"]);

function invalid_passwd() {
    echo "<script>alert(", "Mot de passe invalide.", ");</script>";
    exit;
}
if (preg_match("/^[1-2]\d{2}(?:0[1-9]|1[0-2])\d{8}$/", $account) === 1) {
    $user_info = fetchUser($account);
    if ($user_info !== FALSE) {
        if (!password_verify($passwd, $user_info["password"])) invalid_passwd();
        $_SESSION["user_type"] = "user";
        $_SESSION["user_id"] = $account;
        header("Location: utilisateur.php", true, 303);
        exit;
    }
} elseif (preg_match("/^[^@]+@\S+\.\S+$/", $account) === 1) {
    $user_info = fetchUser($account);
    if ($user_info !== FALSE) {
        if (!password_verify($passwd, $user_info["password"])) invalid_passwd();
        $_SESSION["user_type"] = "user";
        $_SESSION["user_id"] = $user_info["nss"];
        header("Location: utilisateur.php", true, 303);
        exit;
    }
    $user_info = fetchManager($account);
    if ($user_info !== FALSE) {
        if (!password_verify($passwd, $user_info["password"])) invalid_passwd();
        $_SESSION["user_type"] = "manager";
        $_SESSION["user_id"] = $user_info["id"];
        header("Location: manager.php", true, 303);
        exit;
    }
    $user_info = fetchAdmin($account);
    if ($user_info !== FALSE) {
        if (!password_verify($passwd, $user_info["password"])) invalid_passwd();
        $_SESSION["user_type"] = "administrator";
        $_SESSION["user_id"] = $user_info["id"];
        header("Location: admin.php", true, 303);
        exit;
    }
} else echo "<script>alert(", "Identifiant invalide.", ");</script>";
