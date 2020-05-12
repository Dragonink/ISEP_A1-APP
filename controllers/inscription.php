<?php session_start();
require "../models/account_info.php";
$type = $firstname = $lastname = $email = $password = $nss = $linked_manager = $address = "";
function trim_input($data) {
	return htmlspecialchars(stripslashes(trim($data)));
}
$type = trim_input($_POST["type"]);
$firstname = trim_input($_POST["firstname"]);
$lastname = trim_input($_POST["lastname"]);
$password = trim_input($_POST["password"]);
$email = trim_input($_POST["email"]);
$nss = trim_input($_POST["nss"]);
$linked_manager = trim_input($_POST["manager"]);
$address = trim_input($_POST["address"]);

function error() {
    header("Location: inscription.php", true, 303);
    exit;
}
switch ($type) {
    case "user":
        if (preg_match("/^[1-2]\d{2}(?:0[1-9]|1[0-2])\d{10}$/", $nss) === 1) {
            $status = insertUser($db, $nss, $firstname, $lastname, $email, $password, $linked_manager);
            if ($status) {
                $_SESSION["user_type"] = "user";
                $_SESSION["user_id"] = $nss;
                $_SESSION["user_prenom"] = $firstname;
                $_SESSION["user_nom"] = $lastname;
                $_SESSION["user_email"] = $email;
                $_SESSION["user_medecin"] = $linked_manager;
                $_SESSION["user_tel"] = NULL;
                $_SESSION["user_share"] = TRUE;
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
            header("Location: index.php?validation=medecin", true, 303);
            exit;
        } else { error();}
        break;
    case "admin":
        $status = insertAdmin($db, $firstname, $lastname, $email, $password);
        if ($status) {
            header("Location: index.php?validation=admin", true, 303);
            exit;
        } else {error();}
        break;
}
?>
