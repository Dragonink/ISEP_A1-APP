<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") require "../controllers/modif.php";
require "../models/account_info.php";
if (isset($_GET['email']) && $_SESSION["user_type"]!="manager"){
	$user_info = fetchManager($db, $_GET['email']);
	$user["prenom"]=$user_info[0]["first_name"];
	$user["nom"]=$user_info[0]["last_name"];
	$user["adresse"]=$user_info[0]["work_address"];
	$user["tel"]=$user_info[0]["phone"];
	$user["email"]=$user_info[0]["email"];
	$user["id"]=$user_info[0]["id"];
	setcookie("modifAdmin", "true");
} else {
	$user["prenom"]=$_SESSION["user_prenom"];
	$user["nom"]=$_SESSION["user_nom"];
	$user["adresse"]=$_SESSION["user_adresse"];
	$user["tel"]=$_SESSION["user_tel"];
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
	<!-- JS -->
	<script src="js/profil.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

	<!-- CSS -->
	<link href="css/profil.css" rel="stylesheet" type="text/css">
	<link href="css/header-footer.css" rel="stylesheet" type="text/css">

</head>

<body>
	<?php require "_header.php"; ?>
	<main>
	<form method="POST" action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<div id="text">
			<div id="roundedImage">
				<img src="../images/iconProfil.jpg">
			</div>
			<div id="nom"><?php echo $user["prenom"] ?> &nbsp; <?php echo $user["nom"] ?> </div>
			<button type="submit" id="Validation" name="modifGestionnaire">Valider les modifications</button>
			<button type="submit" id="Annulation" name="annuler">Annuler</button>
		</div>
		<h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Informations personnelles </h2>
		<div id="infors">
			<div id="info">
				<p>Nom</p>
				<input type="text" name="nom" placeholder="<?php echo $user["nom"] ?>"  />
				<p>Prénom</p>
				<input type="text" name="prenom" placeholder="<?php echo $user["prenom"] ?>"  />
				<p>Email</p>
				<input type="text" name="email" placeholder="<?php echo $user["email"] ?>" />
				<p>Vérifier Email</p>
				<input type="text" name="verifemail" />
			</div>
			<div id="infos">
				<p>Numéro de téléphone</p>
				<input type="tel" name="telephone" placeholder="<?php echo $user["tel"] ?>" />
				<?php if ($_SESSION["user_type"]=="manager"){
					echo "<p>Mot de passe</p>",
						"<input type=\"password\" name=\"mdp\" placeholder=\"Mot de passe\" />",
						"<p>Confirmation de mot de passe</p>",
						"<input type=\"password\" name=\"verifmdp\">";
				}?>
				<p> Adresse de travail</p>
				<input type="text" name="adresse" placeholder="<?php echo $user["adresse"] ?>" />
				<input type="hidden" name="id" value="<?php echo $user["id"]?>"/>
			</div>
		</div>
	</form>
	</main>
</body>

</html>
