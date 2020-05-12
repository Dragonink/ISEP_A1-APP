<?php if ($_SERVER["REQUEST_METHOD"] === "POST") require "../controllers/connexion.php";
?><!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8" />
	<title>Connexion</title>
	<link rel="stylesheet" type="text/css" href="css/sign.css" />
</head>

<body>
	<header>
		<h1>INFINITE MEASURES</h1>
		<h2>Heureux de vous revoir !<br />Veuillez vous connecter.</h2>
	</header>
	<main>
		<form id="signin" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
			<div>
				<label for="account">Identifiant</label>
				<input id="account" name="account" type="text" required />
				<label for="password">Mot de passe</label>
				<input id="password" name="password" type="password" required />
			</div>
			<button type="submit">Connexion</button>
		</form>
		<div>
			<label for="signup">Vous n'avez pas de compte ?</label>
			<a id="signup" href="inscription.php">S'inscrire</a>
		</div>
	</main>
	<footer>
		<a href="cgu.php">Conditions Générales d'Utilisation</a>
	</footer>
</body>
</head>
