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
	<form method="POST" action ="routeur.php" >
		<div id="text">
			<div id="roundedImage">
				<img src="../images/iconProfil.jpg" />
			</div>
			<div id="nom">Nom Prénom</div> &nbsp; <div id="prénom"></div>

			<div id="Validation">
				<button type="submit" name="modifUtilisateur">Valider les modifications</button>
			</div>
			<div id="Annulation">
				<button type="submit">Annuler</button>
			</div>
		</div>
		<div id="infors">
			<div id="info">
				<h2>Informations personnelles </h2>
				<p>Nom</p>
				<input type="text" name="nom" placeholder="Identifiant" required="required" />
				<p>Prénom</p>
				<input type="text" name="prenom" placeholder="Mot de passe" required="required" />
				<p>Email</p>
				<input type="text" name="email" placeholder="Identifiant" required="required" />
				<p>Vérifier Email</p>
				<input type="text" name="verifemail" placeholder="Mot de passe" required="required" />
			</div>
			<div id="infos">
				<p>Numéro de téléphone</p>
				<input type="text" name="telephone" placeholder="Identifiant" required="required" />
				<p>Mot de passe</p>
				<input type="password" name="mdp" placeholder="Mot de passe" required="required" />
				<p>Confirmation de mot de passe</p>
				<input type="password" name="verifmdp">
				<p>Médecin</p>
				<input type="text" name="medecin" placeholder="Identifiant" required="required" />
				<div>
					<input type="checkbox" id="data" name="scales"
						unchecked>
					<label for="scales">J'accepte que mes données soient réutilisées à des fins statiques</label>
				</div>
			</div>
		</div>
	</form>
</body>

</html>
