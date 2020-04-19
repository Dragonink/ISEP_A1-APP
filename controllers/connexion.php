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
    echo "<script>alert('Mot de passe invalide.');</script>";
}
if (preg_match("/^[1-2]\d{2}(?:0[1-9]|1[0-2])\d{8}$/", $account) === 1) {
    $user_info = fetchUser($db, $account);
    if ($user_info !== FALSE && count($user_info) > 0) {
        if (password_verify($passwd, $user_info["password"])) {
            $_SESSION["user_type"] = "user";
            $_SESSION["user_id"] = $account;
            header("Location: utilisateur.php", true, 303);
        } else {
            invalid_passwd();
        }
        exit;
    }
} elseif (preg_match("/^[^@]+@\S+\.\S+$/", $account) === 1) {
    $user_info = fetchUser($db, $account);
    if ($user_info !== FALSE && count($user_info) > 0) {
        if (password_verify($passwd, $user_info["password"])) {
            $_SESSION["user_type"] = "user";
            $_SESSION["user_id"] = $user_info["nss"];
            header("Location: utilisateur.php", true, 303);
        } else {
            invalid_passwd();
        }
        exit;
    }
    $user_info = fetchManager($db, $account);
    if ($user_info !== FALSE && $user_info["is_active"]==0){
        echo "<script>alert(\"Votre compte n'a pas encore été activé\")</script>";
    } elseif ($user_info !== FALSE && $user_info["is_active"]==-1){
        echo "<script>alert(\"Votre compte a été supprimé\")</script>";
    } elseif ($user_info !== FALSE && count($user_info) > 0) {
        if (password_verify($passwd, $user_info["password"])) {
            $_SESSION["user_type"] = "manager";
            $_SESSION["user_id"] = $user_info["id"];
            header("Location: manager.php", true, 303);
        } else {
            invalid_passwd();
        }
        exit;
    }
    $user_info = fetchAdmin($db, $account);
    if ($user_info !== FALSE && $user_info["is_active"]==0){
        echo "<script>alert(\"Votre compte n'a pas encore été activé\")</script>";
    } elseif ($user_info !== FALSE && $user_info["is_active"]==-1){
        echo "<script>alert(\"Votre compte a été supprimé\")</script>";
    }elseif ($user_info !== FALSE && count($user_info) > 0) {
        if (password_verify($passwd, $user_info["password"])) {
            $_SESSION["user_type"] = "administrator";
            $_SESSION["user_id"] = $user_info["id"];
            header("Location: admin.php", true, 303);
        } else {
            invalid_passwd();
        }
        exit;
    }
} else {echo "<script>alert('Identifiant invalide.');</script>";}
?>