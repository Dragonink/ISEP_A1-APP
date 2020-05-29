<?php 
	if ($_SERVER["REQUEST_METHOD"] === "POST" and (isset($_POST['email']) and $_POST['email']!='')){
		$recup_mail=$_POST['email'];
		require "../controllers/forget.php";
	} elseif ($_SERVER["REQUEST_METHOD"] === "POST" ) require "../controllers/connexion.php";
	if (isset($_COOKIE['invalidpass'])){
		setcookie ("invalidpass");
		echo "<script>alert(\"Mot de passe invalide\")</script>";
	}
?><!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8" />
	<title>Connexion</title>
	<link rel="stylesheet" type="text/css" href="css/sign.css" />
	<script type="text/javascript" src="js/forgetmdp.js"></script>
</head>

<body onload="hideForget()">

	<header>
		<h1>INFINITE MEASURES</h1>
		<h2>Heureux de vous revoir !<br />Veuillez vous connecter.</h2>
	</header>
	<main>
		<form id="signin" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
			<div>
				<!-- Connexion only -->
				<label for="account" class="connexion">Identifiant</label>
				<input id="account" class="connexion" name="account" type="text" required />
				<label for="password" class="connexion">Mot de passe</label>
				<input id="password" class="connexion" name="password" type="password" required />
				<!-- ForgetPassword only -->
				<label for="email" class="forget">Adresse mail</label>
                <input id="email" class="forget" disabled name="email" type="email" required />
			</div>
			<button class="connexion" type="submit">Connexion</button>
			<button class="forget" type="send">Envoyer</button>
		</form>
		<div>
			<label for="signup">Vous n'avez pas de compte ?</label>
			<a id="signup" href="inscription.php">S'inscrire</a>
		</div>
		<div>
			<button class="connexion" type="mdp" onclick="selectType()">Mot de passe oublié</button>
			<button class="forget" type="mdp" onclick="hideForget()">Connexion</button>
		</div>
	</main>
	<footer>
		<a href="cgu.php">Conditions Générales d'Utilisation</a>
	</footer>
</body>

<?php 
	if (isset($recup_mail)){
		$recup_code = "";
		for($i=0; $i < 8; $i++) { 
			$recup_code .= mt_rand(0,9);
		}
		//echo "<script>alert(".$recup_code .")</script>";
		if (compte($db, $recup_mail, $recup_code)){
			$to = $recup_mail;
			$from = 'infinite.measures@yopmail.com';
			$subject = 'Reinitialisation mot de passe';
			$message = '<html>'
					.'<head>'
						.'<title>Réinitialisation de votre mot de passe</title>'
					.'</head>'
					.'<body>'
						.'<h2>Bonjour, voici votre nouveau mot de passe : ' .$recup_code .'</h2>'
						.'<p>Ce mot de passe est strictement confidentielle.</p>'
					.'</body>'
				.'</html>';
			$headers = 'From:' .$from ."\r\nContent-type:text/html;charset=utf-8";
			
			if (mail($to, $subject, $message, $headers))
			{
				echo "<script>alert(\"Un mail vous a été envoyé.\")</script>";
			}
			else
			{
				echo "<script>alert(\"Echec d'envoie du mail.\")</script>";
			}
		} else {
			echo "<script>alert(\"Il y a pas de compte associé à cet mail.\")</script>";
		}
	}