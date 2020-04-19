<?php
session_start(); 
?>
<!DOCTYPE html>
<html>

<head>
	<!-- JS -->
	<script src="js/code.js"></script>
	<script src="js/profil.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

	<!-- CSS -->
	<link href="css/profil.css" rel="stylesheet" type="text/css">
	<link href="css/header-footer.css" rel="stylesheet" type="text/css">

</head>

<body>
	<?php require "_header.php"; ?>
	<form method="POST" action ="modif.php">
		<div id="text">
			<div id="roundedImage">
				<img src="../images/iconProfil.jpg">
			</div>
			<div id="nom">Nom Prénom</div> &nbsp; <div id="prénom"></div>
			<div id="Validation">
				<button type="submit" name="modifGestionnaire">Valider les modifications</button>
			</div>
			<div id="Annulation">
				<button type="submit" name="annuler">Annuler</button>
			</div>
		</div>
		<div id="infors">
			<div id="info">
				<h2>Informations personnelles </h2>
				<p>Nom</p>
				<input type="text" name="nom" placeholder="Nom"  />
				<p>Prénom</p>
				<input type="text" name="prenom" placeholder="Prénom"  />
				<p>Email</p>
				<input type="text" name="email" placeholder="E-mail" />
				<p>Vérifier Email</p>
				<input type="text" name="verifemail" />
			</div>
			<div id="infos">
				<p>Numéro de téléphone</p>
				<input type="int" name="telephone" placeholder="Numéro de telephone" />
				<p>Mot de passe</p>
				<input type="password" name="mdp" placeholder="Mot de passe" />
				<p>Confirmation de mot de passe</p>
				<input type="password" name="verifmdp">
				<p> Adresse de travail</p>
				<input type="text" name="adresse" placeholder="Adresse" />
			</div>
		</div>
	</form>
</body>

</html>
