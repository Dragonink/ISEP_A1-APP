<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") require "../controllers/modif.php";
require "../models/account_info.php";
if (isset($_GET['email']) && $_SESSION["user_email"]!=$user_info[0]["email"]){
    $user_info = fetchAdmin($db, $_GET['email']);
    $user["prenom"]=$user_info[0]["first_name"];
    $user["nom"]=$user_info[0]["last_name"];
    $user["email"]=$user_info[0]["email"];
    $user["id"]=$user_info[0]["id"];
    setcookie("modifAdmin", "true");
} else {
    $user["prenom"]=$_SESSION["user_prenom"];
    $user["nom"]=$_SESSION["user_nom"];
    $user["email"]=$_SESSION["user_email"];
    $user["id"]=$_SESSION["user_id"];
}
if (isset($_COOKIE["modifError"])) {
	switch ($_COOKIE["modifError"]) {
		case "mdp":
			echo "<script>alert('Les mots de passe ne correspondent pas.');</script>";
			break;
		case "email":
			echo "<script>alert('Les adresses Email ne correspondent pas.');</script>";
            break;
        default:
			echo "<script>alert(\"Une erreur est survenue lors de l'enregistrement de vos données.\")</script>";
			break;
	}
	setcookie("modifError");
}
?><!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <!-- JS -->
    <script src="js/admin.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

    <!-- CSS -->
    <link href="css/admin.css" rel="stylesheet" type="text/css">
    <link href="css/header-footer.css" rel="stylesheet" type="text/css">

</head>

<body>
    <?php require "_header.php"; ?>
    <section id="contenuAdmin">
        <form class="modificationProfil" method="POST" action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <h2>Modification profil</h2></br>
            <table>
                <tr>
                    <td>
                        <p>Nom</p>
                    </td>
                    <td><input type="text" name="nom" placeholder="<?php echo $user["nom"]?>" /></td>
                </tr>
                <tr>
                    <td>
                        <p>Prénom</p>
                    </td>
                    <td><input type="text" name="prenom" placeholder="<?php echo $user["prenom"]?>" /></td>
                </tr>
                <tr>
                    <td>
                        <p>E-mail</p>
                    </td>
                    <td><input type="email" name="email" placeholder="<?php echo $user["email"]?>" /></td>
                </tr>
                <tr>
                    <td>
                        <p>Vérification e-mail</p>
                    </td>
                    <td><input type="email" name="verifemail" /></td>
                </tr>
                <?php if (!isset($_GET['email'])){
                    echo "<tr>",
                            "<td>",
                                "<p>Mot de passe</p>",
                            "</td>",
                            "<td><input type=\"password\" name=\"mdp\" pattern=\".{8,}\" title=\"8 caractères minimum, dont :
		- 1 majuscule,
		- 1 minuscule,
		- 1 chiffre,
                - 1 caractère spécial\"/></td>",
                        "</tr>",
                        "<tr>",
                            "<td>",
                                "<p>Vérification mot de passe</p>",
                            "</td>",
                            "<td><input type=\"password\" name=\"verifmdp\" /></td>",
                        "</tr>";
                }?>
            </table>
            <input type="hidden" name="id" value="<?php echo $user["id"]?>"/>
            <div class="boutons">
                <button type="reset" id="annuler" name="annuler"> Annuler </button>
                <button type="submit" id="valider" name="modifAdmin"> Valider </button>
            </div>
        </form>
    </section>
</body>

</html>
