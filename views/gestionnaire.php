<?php
session_start();
if (!isset($_GET['q'])){
	htmlspecialchars($_GET['q']='');
}
if (!isset($_GET['tri'])){
	htmlspecialchars($_GET['tri']=0);
}
if (!isset($_GET['criteres'])){
	htmlspecialchars($_GET['criteres']=0);
}
if (!isset($_GET['typedetest'])){
	htmlspecialchars($_GET['typedetest']=0);
}
if (isset($_GET["fonction"])){
    if (($_GET["fonction"]=='utilisateur') && (isset($_GET["value"]) && isset($_GET["recherche"]))){
		echo listeInfoUtilisateur($db, $_GET["value"], $_GET["recherche"]);
	}
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
	require "../controllers/declare_exam.php";
}
require '../controllers/gestionnaire.php';
if (isset($_COOKIE["modifState"])) {
	setcookie("modifState");
	echo "<script>alert('Vos modifications ont bien été enregistrées.')</script>";
}
?><!DOCTYPE html>
<meta charset="UTF-8">
<html>

<head>
	<!-- JS -->
	<script src="js/profil.js"></script>
	<script type="text/javascript" src="RGraph/RGraph.common.core.js"></script>
	<script type="text/javascript" src="RGraph/RGraph.common.dynamic.js"></script>
	<script type="text/javascript" src="RGraph/RGraph.common.key.js"></script>
	<script type="text/javascript" src="RGraph/RGraph.drawing.rect.js"></script>
	<script type="text/javascript" src="RGraph/RGraph.bar.js"></script>
	<script type="text/javascript" src="RGraph/RGraph.common.tooltips.js"></script>
	<script type="text/javascript" src="RGraph/RGraph.pie.js"></script>

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
			<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
				<input type="text" name="user" hidden />
				<div class="testChoix">
					<div>Fréquence cardiaque</div>
					<input type="checkbox" class="test" name="tests[]" value="freq" unchecked>
				</div>
				<div class="testChoix">
					<div>Température</div>
					<input type="checkbox" class="test" name="tests[]" value="temp" unchecked>
				</div>
				<div class="testChoix">
					<div>Reconnaissance de tonalités</div>
					<input type="checkbox" class="test" name="tests[]" value="tona" unchecked>
				</div>
				<div class="testChoix">
					<div>Réaction à des stimuli visuels</div>
					<input type="checkbox" class="test" name="tests[]" value="stim" unchecked>
				</div>
				<div class="testChoix">
					<div>Mémorisation de couleurs</div>
					<input type="checkbox" class="test" name="tests[]" value="colo" unchecked>
				</div>
				<div class="buttons">
					<button type="submit" id="valider">Valider</button>
					<button type="button" id="annuler" onclick="annulerExamen()">Annuler</button>
				</div>
			</form>
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
					<div class="resultatsTests" style="display: block;">
						<canvas id="grapheResultat" width='1000' height='400'></canvas>
					</div>
					<form class="affichage" action = "gestionnaire.php" method = "get">
						<select id="criteres" name="criteres" >
							<option value="0"> Nombre </option>
							<option value="1"> Sexe</option>
							<option value="2"> Age </option>
						</select>
						<select id='typedetest' name='typedetest'>
							<option value='0'> Type de test </option>
							<option value='1'> Fréquence cardiaque </option>
							<option value='2'> Température </option>
							<option value='3'> Reconnaissance de tonalités </option>
							<option value='4'> Réaction à des stimuli visuels </option>
							<option value='5'> Mémorisation de couleurs </option>
						</select>
						<input type="submit" value="Afficher" />
					</form>
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
	<div id="listeInfoPatient"><?php echo listeInfoPatient($db, 0, ''); ?></div>
	<?php require "_footer.html"; ?>
</body>
</html>
<?php
	$keys="[";
	$datas="[";
	$labels="[";
	if ($_GET['criteres']==0){
		if ($_GET['typedetest']==0){
			$nb=nbTestReal($db);
			for ($i=0; $i<count($nb); $i++){
				if ($nb[$i]['type']!=NULL){
					$datas.="'" .$nb[$i]['nb'] ."'";
					if ($nb[$i]['type']=='freq'){
						$labels.="'Fréquence cardiaque'";
					}elseif ($nb[$i]['type']=='temp'){
						$labels.="'Température'";
					}elseif ($nb[$i]['type']=='tona'){
						$labels.="'Reconnaissance de tonalités'";
					}elseif ($nb[$i]['type']=='stim'){
						$labels.="'Réaction à des stimuli visuels'";
					}elseif ($nb[$i]['type']=='colo'){
						$labels.="'Mémorisation de couleurs'";
					}
					if ($i!=4){
						$datas.=",";
						$labels.=",";
					}
				}
			}
			if ($datas=="["){
				$datas.=1;
				$labels.="'Aucun test a été réalisé'";
			}
		} else {
			if ($_GET['typedetest']==1){
				$nom="freq";
			}elseif ($_GET['typedetest']==2){
				$nom="temp";
			}elseif ($_GET['typedetest']==3){
				$nom="tona";
			}elseif ($_GET['typedetest']==4){
				$nom="stim";
			}elseif ($_GET['typedetest']==5){
				$nom="colo";
			}
			$resulTest=resulTest($db, $nom);
			if (count($resulTest)==0){
				$datas.=0;
				$labels.="'Aucun test a été réalisé'";
			}else {
				for ($i=0; $i<count($resulTest); $i++){
					$datas .= "'" .$resulTest[$i]["result"]  ."'";
					$labels .= "'" .$resulTest[$i]["prenom"] ." " .$resulTest[$i]["nom"] ."'";
					if ( $i<count($resulTest)-1){
						$datas.=",";
						$labels.=",";
					}
				}
			}
		}
	} elseif ($_GET['criteres']==1){
		if ($_GET['typedetest']==0){
			for ($j=1; $j<=2 ;$j++){
				$freqExam = 0;
				$tempExam = 0;
				$tonaExam = 0;
				$stimExam = 0;
				$coloExam = 0;
				$nbTestRealSpec=nbTestRealSpec($db,$_GET['criteres'],$j);
				for ($i=0; $i<count($nbTestRealSpec); $i++){
					if ($nbTestRealSpec[$i]['type']!=NULL){
						if ($nbTestRealSpec[$i]['type']=='freq'){
							$freqExam= $nbTestRealSpec[$i]['nb'];
						}elseif ($nbTestRealSpec[$i]['type']=='temp'){
							$tempExam= $nbTestRealSpec[$i]['nb'];
						}elseif ($nbTestRealSpec[$i]['type']=='tona'){
							$tonaExam= $nbTestRealSpec[$i]['nb'];
						}elseif ($nbTestRealSpec[$i]['type']=='stim'){
							$stimExam= $nbTestRealSpec[$i]['nb'];
						}elseif ($nbTestRealSpec[$i]['type']=='colo'){
							$coloExam= $nbTestRealSpec[$i]['nb'];
						}
					}
				}
				$datas.="[".$freqExam.",".$tempExam.",".$tonaExam.",".$stimExam.",".$coloExam."]";
				if ($j==1){
					$datas.=",";
				}
			}
			$labels.="'Homme','Femme'";
			$keys.="'Fréquence','Température','Tonalités', 'Stimuli' , 'Simon'";
		} else {
			if ($_GET['typedetest']==1){
				$nom="freq";
			}elseif ($_GET['typedetest']==2){
				$nom="temp";
			}elseif ($_GET['typedetest']==3){
				$nom="tona";
			}elseif ($_GET['typedetest']==4){
				$nom="stim";
			}elseif ($_GET['typedetest']==5){
				$nom="colo";
			}
			for ($j=1; $j<=2 ;$j++){
			$mTestRealSpec=mTestRealSpec($db,$_GET['criteres'],$nom,$j);
			$liste=array();
				if (count($mTestRealSpec)==0){
					$liste[0]= 0;
				} else {
					for($i=0;$i<count($mTestRealSpec);$i++){
						$liste[$i]=$mTestRealSpec[$i]['result'];
					}
				}
				if (count($liste)!=1){
					$datas .= array_sum($liste)/count($liste);
				}else{
					$datas.=$liste[0];
				}
				if ($j==1){
					$datas.=",";
				}
			}
			$labels.="'Homme','Femme'";
		}
	}elseif ($_GET['criteres']==2){
		if ($_GET['typedetest']==0){
			for ($j=2; $j<=9 ;$j++){
				$freqExam = 0;
				$tempExam = 0;
				$tonaExam = 0;
				$stimExam = 0;
				$coloExam = 0;
				$nbTestRealSpec=nbTestRealSpec($db,$_GET['criteres'],$j);
				for ($i=0; $i<count($nbTestRealSpec); $i++){
					if ($nbTestRealSpec[$i]['type']!=NULL){
						if ($nbTestRealSpec[$i]['type']=='freq'){
							$freqExam= $nbTestRealSpec[$i]['nb'];
						}elseif ($nbTestRealSpec[$i]['type']=='temp'){
							$tempExam= $nbTestRealSpec[$i]['nb'];
						}elseif ($nbTestRealSpec[$i]['type']=='tona'){
							$tonaExam= $nbTestRealSpec[$i]['nb'];
						}elseif ($nbTestRealSpec[$i]['type']=='stim'){
							$stimExam= $nbTestRealSpec[$i]['nb'];
						}elseif ($nbTestRealSpec[$i]['type']=='colo'){
							$coloExam= $nbTestRealSpec[$i]['nb'];
						}
					}
				}
				$datas.="[".$freqExam.",".$tempExam.",".$tonaExam.",".$stimExam.",".$coloExam."]";
				$datas.=",";
			}
			for ($j=0; $j<=1 ;$j++){
				$freqExam = 0;
				$tempExam = 0;
				$tonaExam = 0;
				$stimExam = 0;
				$coloExam = 0;
				$nbTestRealSpec=nbTestRealSpec($db,$_GET['criteres'],$j);
				for ($i=0; $i<count($nbTestRealSpec); $i++){
					if ($nbTestRealSpec[$i]['type']!=NULL){
						if ($nbTestRealSpec[$i]['type']=='freq'){
							$freqExam= $nbTestRealSpec[$i]['nb'];
						}elseif ($nbTestRealSpec[$i]['type']=='temp'){
							$tempExam= $nbTestRealSpec[$i]['nb'];
						}elseif ($nbTestRealSpec[$i]['type']=='tona'){
							$tonaExam= $nbTestRealSpec[$i]['nb'];
						}elseif ($nbTestRealSpec[$i]['type']=='stim'){
							$stimExam= $nbTestRealSpec[$i]['nb'];
						}elseif ($nbTestRealSpec[$i]['type']=='colo'){
							$coloExam= $nbTestRealSpec[$i]['nb'];
						}
					}
				}
				$datas.="[".$freqExam.",".$tempExam.",".$tonaExam.",".$stimExam.",".$coloExam."]";
				if ($j==0){
					$datas.=",";
				}
			}
			$labels.="'1920-1929','1930-1939','1940-1949','1950-1959','1960-1969','1970-1979','1980-1989','1990-1999','2000-2009','2010-2019'";
			$keys.="'Fréquence','Température','Tonalités', 'Stimuli' , 'Simon'";
		} else {
			if ($_GET['typedetest']==1){
				$nom="freq";
			}elseif ($_GET['typedetest']==2){
				$nom="temp";
			}elseif ($_GET['typedetest']==3){
				$nom="tona";
			}elseif ($_GET['typedetest']==4){
				$nom="stim";
			}elseif ($_GET['typedetest']==5){
				$nom="colo";
			}
			for ($j=2; $j<=9 ;$j++){
				$mTestRealSpec=mTestRealSpec($db,$_GET['criteres'],$nom,$j);
				$liste=array();
				if (count($mTestRealSpec)==0){
					$liste[0]= 0;
				} else {
					for($i=0;$i<count($mTestRealSpec);$i++){
						$liste[$i]=$mTestRealSpec[$i]['result'];
					}
				}
				if (count($liste)!=1){
					$datas .= array_sum($liste)/count($liste);
				}else{
					$datas.=$liste[0];
				}
				$datas.=",";
			}
			for ($j=0; $j<=1 ;$j++){
				$mTestRealSpec=mTestRealSpec($db,$_GET['criteres'],$nom,$j);
				$liste=array();
				if (count($mTestRealSpec)==0){
					$liste[0]= 0;
				} else {
					for($i=0;$i<count($mTestRealSpec);$i++){
						$liste[$i]=$mTestRealSpec[$i]['result'];
					}
				}
				if (count($liste)!=1){
					$datas .= array_sum($liste)/count($liste);
				}else{
					$datas.=$liste[0];
				}
				$datas.=",";
			}
			$labels.="'1920-1929','1930-1939','1940-1949','1950-1959','1960-1969','1970-1979','1980-1989','1990-1999','2000-2009','2010-2019'";
		}
	}
	$keys.="]";
	$datas.="]";
	$labels.="]";
?>
<script>
	graphe(<?php echo $_GET['criteres']?>, <?php echo $_GET['typedetest'] ?>, <?php echo $datas?>, <?php echo $labels ?>, <?php echo $keys ?>);
	let value=/(?:^\?|&)tri=(\d+)/.exec(window.location.search);
	if (value!==null){
		document.querySelector('form.recherche select').selectedIndex = value[1];
	}
	let value1=/(?:^\?|&)criteres=(\d+)/.exec(window.location.search);
	let value2=/(?:^\?|&)typedetest=(\d+)/.exec(window.location.search);
	if (value1!==null && value2!==null ){
		document.querySelector('form.affichage #criteres').selectedIndex = value1[1];
		document.querySelector('form.affichage #typedetest').selectedIndex = value2[1];
	}
</script>
