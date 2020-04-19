<?php session_start(); 
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
    echo "<script>alert('Une erreur est survenue.');</script>";
    exit;
}
switch ($type) {
    case "user":
        if (preg_match("/^[1-2]\d{2}(?:0[1-9]|1[0-2])\d{8}$/", $nss) === 1) {
            $status = insertUser($db, $nss, $firstname, $lastname, $email, $password, $linked_manager);
            if ($status) {
                $_SESSION["user_type"] = "user";
                $_SESSION["user_id"] = $nss;
                header("Location: utilisateur.php", true, 303);
            } else {
                error();
            }
        } else {
            echo "<script>alert('Le numéro de Sécurité Sociale est invalide.');</script>";
        }
        exit;
        break;
    case "manager":
        $status = insertManager($db, $firstname, $lastname, $email, $password, $address);
        if ($status) {
            header("Location: index.php?Validation=true", true, 303);
            exit;
        } else { error();}
        break;
    case "administrator":
        $status = insertAdmin($db, $firstname, $lastname, $email, $password);
        if ($status) {
            header("Location: index.php?Validation=true", true, 303);
            exit;
        } else {error();}
        break;
}
?>