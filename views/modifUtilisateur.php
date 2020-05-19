<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") require "../controllers/modif.php";
require "../models/account_info.php";
$manager_info = fetchManager2($db, $_SESSION["user_medecin"]);
$manager_info = $manager_info[0];
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
	<form method="POST" action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
		<div id="text">
			<div id="roundedImage">
				<img src="../images/iconProfil.jpg" />
			</div>
			<div id="nom"><?php echo $_SESSION["user_prenom"]?> &nbsp; <?php echo $_SESSION["user_nom"]?></div>
			<button type="submit" id="Validation" name="modifUtilisateur">Valider les modifications</button>
			<button type="submit" id="Annulation" name="annuler">Annuler</button>
		</div>
		<h2>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;Informations personnelles </h2>
		<div id="infors">
			<div id="info">
				<p>Nom</p>
				<input type="text" name="nom" placeholder="<?php echo $_SESSION["user_nom"]?> " />
				<p>Prénom</p>
				<input type="text" name="prenom" placeholder="<?php echo $_SESSION["user_prenom"]?>" />
				<p>Email</p>
				<input type="text" name="email" placeholder="<?php echo $_SESSION["user_email"]?>" />
				<p>Vérifier Email</p>
				<input type="text" name="verifemail" />
			</div>
			<div id="infos">
				<p>Numéro de téléphone</p>
				<input type="tel" name="telephone" placeholder="<?php echo $_SESSION["user_tel"]?>" />
				<p>Mot de passe</p>
				<input type="password" name="mdp" placeholder="Mot de passe" />
				<p>Confirmation de mot de passe</p>
				<input type="password" name="verifmdp">
				<p>Médecin</p>
				<input type="text" name="medecin" placeholder="<?php echo $manager_info['first_name'], " ", $manager_info['last_name']?>" />
				<div>
					<input type="checkbox" id="data" name="checkbox" unchecked />
					<label for="checkbox">J'accepte que mes données soient réutilisées à des fins statiques</label>
				</div>
			</div>
		</div>
	</form>
	</main>
</body>

</html>
