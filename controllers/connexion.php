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
    if ($user_info !== '' && count($user_info) > 0) {
        if (password_verify($passwd, $user_info[0]["password"])) {
            $_SESSION["user_type"] = "user";
            $_SESSION["user_id"] = $account;
            $_SESSION["user_prenom"] = $user_info[0]["first_name"];
            $_SESSION["user_nom"] = $user_info[0]["last_name"];
            $_SESSION["user_email"] = $user_info[0]["email"];
            $_SESSION["user_medecin"] = $user_info[0]["manager"];
            $_SESSION["user_tel"] = $user_info[0]["phone"];
            $_SESSION["user_share"] = $user_info[0]["ack_share"];
            header("Location: utilisateur.php", true, 303);
        } else {
            invalid_passwd();
        }
        exit;
    }
} elseif (preg_match("/^[^@]+@\S+\.\S+$/", $account) === 1) {
    $user_info = fetchUser2($db, $account);
    if ($user_info !== '' && count($user_info) > 0) {
        if (password_verify($passwd, $user_info[0]["password"])) {
            $_SESSION["user_type"] = "user";
            $_SESSION["user_id"] = $user_info[0]["nss"];
            $_SESSION["user_prenom"] = $user_info[0]["first_name"];
            $_SESSION["user_nom"] = $user_info[0]["last_name"];
            $_SESSION["user_email"] = $user_info[0]["email"];
            $_SESSION["user_medecin"] = $user_info[0]["manager"];
            $_SESSION["user_tel"] = $user_info[0]["phone"];
            $_SESSION["user_share"] = $user_info[0]["ack_share"];
            header("Location: utilisateur.php", true, 303);
        } else {
            invalid_passwd();
        }
        exit;
    }
    $user_info = fetchManager($db, $account);
    if ($user_info !== '' && $user_info[0]["is_active"]===0){
        echo "<script>alert(\"Votre compte n'a pas encore été activé\")</script>";
    } elseif ($user_info !== '' && $user_info[0]["is_active"]==-1){
        echo "<script>alert(\"Votre compte a été supprimé\")</script>";
    } elseif ($user_info !== '' && count($user_info) > 0) {
        if (password_verify($passwd, $user_info[0]["password"])) {
            $_SESSION["user_type"] = "manager";
            $_SESSION["user_id"] = $user_info[0]["id"];
            $_SESSION["user_prenom"] = $user_info[0]["first_name"];
            $_SESSION["user_nom"] = $user_info[0]["last_name"];
            $_SESSION["user_email"] = $user_info[0]["email"];
            $_SESSION["user_tel"] = $user_info[0]["phone"];
            $_SESSION["user_adresse"] = $user_info[0]["work_address"];
            header("Location: gestionnaire.php", true, 303);
        } else {
            invalid_passwd();
        }
        exit;
    }
    $user_info = fetchAdmin($db, $account);
    if ($user_info !== '' && $user_info[0]["is_active"]===0){
        echo "<script>alert(\"Votre compte n'a pas encore été activé\")</script>";
    } elseif ($user_info !== '' && $user_info[0]["is_active"]==-1){
        echo "<script>alert(\"Votre compte a été supprimé\")</script>";
    }elseif ($user_info !== '' && count($user_info) > 0) {
        if (password_verify($passwd, $user_info[0]["password"])) {
            $_SESSION["user_type"] = "administrator";
            $_SESSION["user_id"] = $user_info[0]["id"];
            $_SESSION["user_prenom"] = $user_info[0]["first_name"];
            $_SESSION["user_nom"] = $user_info[0]["last_name"];
            $_SESSION["user_email"] = $user_info[0]["email"];
            header("Location: admin.php", true, 303);
        } else {
            invalid_passwd();
        }
        exit;
    }
} else {echo "<script>alert('Identifiant invalide.');</script>";}
?>