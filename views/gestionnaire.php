<?php
session_start();
?>
<!DOCTYPE html>
<meta charset="UTF-8">
<html>

<head>

	<!-- JS -->
	<script src="js/code.js"></script>
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
				<input type="checkbox" class="test" name="test1" unchecked>
			</div>
			<div class="testChoix">
				<div> Test 2</div>
				<div> Description</div>
				<input type="checkbox" class="test" name="test2" unchecked>
			</div>
			<div class="testChoix">
				<div> Test 3</div>
				<div> Description</div>
				<input type="checkbox" class="test" name="test3" unchecked>
			</div>
			<div class="testChoix">
				<div> Test 4</div>
				<div> Description</div>
				<input type="checkbox" class="test" name="test4" unchecked>
			</div>
			<div class="testChoix">
				<div> Test 5</div>
				<div> Description</div>
				<input type="checkbox" class="test" name="test5" unchecked>
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
                    if ($manager_info["phone"] === NULL) echo "N/A";
                    else echo $manager_info["phone"];
                ?></div>
				<div>Adresse du cabinet : <?php echo $manager_info["work_address"]; ?></div>
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
		<div class="recherche">
			<select size="1">
				<option value disabled selected> Trier par: </option>
				<option value="1"> Option 1 </option>
				<option value="2"> Option 2 </option>
			</select>
			<input type="search" id="search-patient" name="searchPatient" aria-label="Search through site content" placeholder="Recherche"> </td>
		</div>
	</div>
	<table class="affichageResultat">
		<tr>
			<td>
				<table class="utilisateur">
					<tr>
						<td rowspan="4" class="photoProfil"> <img src="images/iconProfil.jpg" /></td>
						<td> Nom Prénom </td>
					</tr>
					<tr>
						<td> Info 1 </td>
					</tr>
					<tr>
						<td> Info 2 </td>
					</tr>
					<tr>
						<td class="iconGerer">
							<img src="images/iconCheck.png" onclick="openExamen()" />
							<img src="images/iconVoirProfil.png" />
							<img src="images/iconContacter.png" />
						</td>
					</tr>
				</table>
			</td>
			<td> </td>
			<td> </td>
			<td> </td>
		</tr>
	</table>
	<?php require "_footer.html"; ?>
</body>
<script LANGUAGE="JavaScript">
	graphe();
</script>

</html>
