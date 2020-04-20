<?php
session_start(); 
?>
<!DOCTYPE html>
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
	<form method="POST" action ="modif.php">
		<div id="text">
			<div id="roundedImage">
				<img src="../images/iconProfil.jpg">
			</div>
			<div id="nom"><?php echo $_SESSION["user_prenom"] ?> &nbsp; <?php echo $_SESSION["user_nom"] ?> </div>
			<button type="submit" id="Validation" name="modifGestionnaire">Valider les modifications</button>
			<button type="submit" id="Annulation" name="annuler">Annuler</button>
		</div>
		<h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Informations personnelles </h2>
		<div id="infors">
			<div id="info">
				<p>Nom</p>
				<input type="text" name="nom" placeholder="<?php echo $_SESSION["user_nom"] ?>"  />
				<p>Prénom</p>
				<input type="text" name="prenom" placeholder="<?php echo $_SESSION["user_prenom"] ?>"  />
				<p>Email</p>
				<input type="text" name="email" placeholder="<?php echo $_SESSION["user_email"] ?>" />
				<p>Vérifier Email</p>
				<input type="text" name="verifemail" />
			</div>
			<div id="infos">
				<p>Numéro de téléphone</p>
				<input type="int" name="telephone" placeholder="<?php echo $_SESSION["user_tel"] ?>" />
				<p>Mot de passe</p>
				<input type="password" name="mdp" placeholder="Mot de passe" />
				<p>Confirmation de mot de passe</p>
				<input type="password" name="verifmdp">
				<p> Adresse de travail</p>
				<input type="text" name="adresse" placeholder="<?php echo $_SESSION["user_adresse"] ?>" />
			</div>
		</div>
	</form>
	</main>
</body>

</html>
