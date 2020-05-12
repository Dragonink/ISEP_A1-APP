<?php
session_start();
if (!isset($_GET['q'])){
	htmlspecialchars($_GET['q']='');
}
if (!isset($_GET['tri'])){
	htmlspecialchars($_GET['tri']=0);
}
if (isset($_GET["fonction"])){
    if (($_GET["fonction"]=='utilisateur') && (isset($_GET["value"]) && isset($_GET["recherche"]))){
		echo listeInfoUtilisateur($db, $_GET["value"], $_GET["recherche"]);
	}
}
require '../controllers/gestionnaire.php';
?>
<!DOCTYPE html>
<meta charset="UTF-8">
<html>

<head>
	<!-- JS -->
	<script src="js/profil.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
	<script src="https://www.chartjs.org/samples/latest/utils.js"></script> <!-- genere des valeurs aléatoires-->

	<!-- CSS -->
	<link href="css/profil.css" rel="stylesheet" type="text/css">
	<link href="css/header-footer.css" rel="stylesheet" type="text/css">

</head>

<body>
	<?php require "_header.php"; ?>
	<div class="examen" style="display: none;">
		<div class="content">
			<div class="personne">
				<img src="images/iconProfil.jpg" />
				<div>Prénom</div> &nbsp; <div> Nom </div>
			</div>
			<hr>
			<p>Liste des tests disponibles</p>
			<div class="testChoix">
				<div> Test 1 </div>
				<div> Description</div>
				<input type="checkbox" class="test" name="test1" unchecked/>
			</div>
			<div class="testChoix">
				<div> Test 2</div>
				<div> Description</div>
				<input type="checkbox" class="test" name="test2" unchecked/>
			</div>
			<div class="testChoix">
				<div> Test 3</div>
				<div> Description</div>
				<input type="checkbox" class="test" name="test3" unchecked/>
			</div>
			<div class="testChoix">
				<div> Test 4</div>
				<div> Description</div>
				<input type="checkbox" class="test" name="test4" unchecked/>
			</div>
			<div class="testChoix">
				<div> Test 5</div>
				<div> Description</div>
				<input type="checkbox" class="test" name="test5" unchecked/>
			</div>
			<div class="buttons">
				<button id="valider"> Valider </button>
				<button id="annuler" onclick="annulerExamen()"> Annuler </button>
			</div>
		</div>
	</div>
	<table class="infoProfil">
		<tr>
			<td class="donneesPersonnelles">
				<div>
					<img src="images/iconProfil.jpg" />
					<div><?php echo $_SESSION["user_prenom"]; ?></div> &nbsp; <div><?php echo $_SESSION["user_nom"]; ?></div>
				</div>
				<div>E-mail <?php echo $_SESSION["user_email"]; ?></div>
				<div>Numéro de téléphone: <?php
                    if ($_SESSION["user_tel"] === NULL) echo "N/A";
                    else echo $_SESSION["user_tel"];
                ?></div>
				<div>Adresse du cabinet : <?php echo $_SESSION["user_adresse"]; ?></div>
			</td>
			<td id="stats">
				<div class="statistiques">
					<div class="resultatsTests">
						<canvas id="grapheResultat" width='550' height='400'></canvas>
					</div>
					<div class="legende">
						<select id="criteres" name="critères" onChange="graphe()">
							<option value="0"> Critères </option>
							<option value="1"> Sexe</option>
							<option value="2"> Age </option>
						</select>
						<select id='type de test' class='typedetest' onChange='graphe()'>
							<option value='0'> Type de test </option>
							<option value='1'> test1 </option>
							<option value='2'> test2 </option>
							<option value='3'> test3 </option>
							<option value='4'> test4 </option>
							<option value='5'> test5 </option>
						</select>
					</div>
				</div>
			</td>
		</tr>
	</table>
	<hr>
	<div id="patient">
		<h1> Vos patients </h1>
		<form class="recherche" action = "gestionnaire.php" method = "get">
			<select size="1" name="tri">
				<option value="0"> Tri par NSS </option>
				<option value="1"> Prénom </option>
				<option value="2"> Nom </option>
			</select>
				<input type="search" name="q" placeholder="Recherche..."/>
   				<input type="submit" value="Rechercher" />
 		</form>
	</div>
	<div id="listeInfoPatient"><?php echo listeInfoPatient($db, $_GET['tri'], $_GET['q'])?></div>
	<?php require "_footer.html"; ?>
</body>
<script LANGUAGE="JavaScript">
	graphe();
	let value=/(?:^\?|&)tri=(\d+)/.exec(window.location.search);
	if (value!==null){
		document.querySelector('form.recherche select').selectedIndex = value[1];
 	}
</script>

</html>
