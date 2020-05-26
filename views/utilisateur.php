<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
	require "../controllers/start_exam.php";
}
require "../models/account_info.php";
$manager_info = fetchManager2($db, $_SESSION["user_medecin"]);
$manager_info = $manager_info[0];
require "../models/requeteTests.php";
$exam = getExamId($db, $_SESSION["user_id"]);
if (count($exam) > 0) {
    $_SESSION["exam_id"] = $exam[0]["id"];
    $tests = getTests($db, $_SESSION["exam_id"]);
}
if (isset($_COOKIE["modifState"])) {
    setcookie("modifState");
	echo "<script>alert('Vos modifications ont bien été enregistrées.')</script>";
}
if (!isset($_GET['choix'])){
	htmlspecialchars($_GET['choix']=0);
}
?><!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <!-- JS -->
    <script src="js/profil.js"></script>
    <script type="text/javascript" src="RGraph/RGraph.common.core.js"></script>
    <script type="text/javascript" src="RGraph/RGraph.common.dynamic.js"></script>
    <script type="text/javascript" src="RGraph/RGraph.bar.js"></script>
    <script type="text/javascript" src="RGraph/RGraph.line.js"></script>
    <script type="text/javascript" src="RGraph/RGraph.common.key.js"></script>

    <!-- CSS -->
    <link href="css/profil.css" rel="stylesheet" type="text/css">
    <link href="css/header-footer.css" rel="stylesheet" type="text/css">

</head>

<body>
    <?php require "_header.php"; ?>

    <table class="infoProfil">
        <tr>
            <td class="donneesPersonnelles">
                <div>
                    <img src="images/iconProfil.jpg" />
                    <div><?php echo $_SESSION["user_prenom"] ?></div> &nbsp; <div><?php echo $_SESSION["user_nom"] ?></div>
                </div>
                <div>Sexe: <?php
                    switch (substr($_SESSION["user_id"], 0, 1)) {
                        case "1":
                            echo "Homme";
                            break;
                        case "2":
                            echo "Femme";
                            break;
                    }
                ?></div>
                <div> Date de naissance: <?php echo substr($_SESSION["user_id"],3,2), "/", substr($_SESSION["user_id"], 1, 2); ?></div>
                <div>E-mail: <?php echo $_SESSION["user_email"] ?></div>
                <div>Numéro de sécurité sociale: <?php echo $_SESSION["user_id"]; ?></div>
                <div>Numéro de téléphone: <?php
                    if ($_SESSION["user_tel"] === NULL){
                        echo "N/A";
                    } else {
                        echo $_SESSION["user_tel"];
                    }
                ?></div>
                <div>Médecin: <?php
                    if ($_SESSION["user_medecin"] === NULL) {
                        echo "ERREUR";
                    } else {
                        echo $manager_info["first_name"], " ", $manager_info["last_name"];
                    }
                ?></div>
            </td>
            <td class="resultatDernierTest">
                <canvas id="resultatDernierTestGraph" width="800" height="300"> </canvas>

                <?php if (sizeof($tests) > 0) {
                    echo "<form method='POST' action='".htmlspecialchars($_SERVER["PHP_SELF"])."'>",
                        "<header>Effectuer un test</header>",
                        "<div>",
                        "<input type='text' name='tests' value='" . implode(" ", $tests) . "' hidden required />",
                        "<input type='text' name='console' placeholder='ID console' required />",
                        "<button type='submit'>Démarrer</button>",
                        "</div>",
                        "</form>";
                } ?>
            </td>
        </tr>
    </table>
    <hr>
    <table class="resultatTest">
        <tr>
            <td class="titre"> Résultats des tests </td>
            <td class="choix">
            <form method ="GET" action="utilisateur.php" class="graphe">
                <select id="choix" size="1" name="choix">
                    <option value="0"> Tout les test </option>
                    <option value="1"> Fréquence </option>
                    <option value="2"> Température </option>
                    <option value="3"> Tonalités</option>
                    <option value="4"> Stimuli </option>
                    <option value="5"> Simon </option>
                </select>
                <input type="submit" value="voir graphe">
                </form>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="test">
                <canvas id="resultatTestGraph" width="1300" height="500"></canvas>
            </td>
        </tr>
    </table>
    <?php require "_footer.html"; ?>
</body>
<?php
$sfreq=0;
$stemp=0;
$stona=0;
$sstim=0;
$scolo=0;
$utilisateurTest=utilisateurTest($db);

for ($i=0; $i<count($utilisateurTest); $i++){
    if ($utilisateurTest[$i]['type']=='freq'){
        $sfreq = $utilisateurTest[$i]['result'];
    }elseif ($utilisateurTest[$i]['type']=='temp'){
        $stemp = $utilisateurTest[$i]['result'];
    }elseif ($utilisateurTest[$i]['type']=='tona'){
        $stona = $utilisateurTest[$i]['result'];
    }elseif ($utilisateurTest[$i]['type']=='stim'){
        $sstim= $utilisateurTest[$i]['result'];
    }elseif ($utilisateurTest[$i]['type']=='colo'){
        $scolo = $utilisateurTest[$i]['result'];
    }
}
$datas="[" .$sfreq ."," .$stemp ."," .$stona ."," .$sstim ."," .$scolo ."]";
$labels="['Fréquence','Température', 'Tonalités', 'Stimuli' , 'Simon' ]";

$choix=$_GET['choix'];
$label='[';
$key='';
$nbExam=count(nbExam($db)[0]);
$utilisateurTest2=utilisateurTest2($db);
if ($choix==0){
    if ($nbExam==0){
        $data.="[0]";
        $label.="'Aucun test a été réalisé'";
    }else {
        $var=0;
        for ($i=0; $i<$nbExam; $i++){
            $lfreq[$i]=0;
            $ltemp[$i]=0;
            $ltona[$i]=0;
            $lstim[$i]=0;
            $lcolo[$i]=0;
            for ($j=$var; $j<count($utilisateurTest2);$j++){
                if (($j==$var) || ($utilisateurTest2[$j]['exam']==$utilisateurTest2[$j-1]['exam'])){
                    if ($utilisateurTest2[$j]['type']=='freq'){
                        $lfreq[$i] = $utilisateurTest2[$j]['result'];
                    }elseif ($utilisateurTest2[$j]['type']=='temp'){
                        $ltemp[$i] = $utilisateurTest2[$j]['result'];
                    }elseif ($utilisateurTest2[$j]['type']=='tona'){
                        $ltona[$i] = $utilisateurTest2[$j]['result'];
                    }elseif ($utilisateurTest2[$j]['type']=='stim'){
                        $lstim[$i] = $utilisateurTest2[$j]['result'];
                    }elseif ($utilisateurTest[$j]['type']=='colo'){
                        $lcolo[$i] = $utilisateurTest2[$j]['result'];
                    }
                } else {
                    $var=$j;
                }
            }
            $nb=$i+1;
            $label .= "'Exam " .$nb ."'";
            if ($i<($nbExam-1)){
                $label.=",";
            }
        }
    }
    $key="['Fréquence','Température', 'Tonalités', 'Stimuli' , 'Simon' ]";
    $label.="]";
    $data[0]="[" .implode(',',$lfreq) ."]";
    $data[1]="[" .implode(',',$ltemp) ."]";
    $data[2]="[" .implode(',',$ltona) ."]";
    $data[3]="[" .implode(',',$lstim) ."]";
    $data[4]="[" .implode(',',$lcolo) ."]";
    
}else{
    $data = "[";
    if ($choix==1){
        $nom='freq';
    }else if ($choix==2){
        $nom='temp';
    }else if ($choix==3){
        $nom='tona';
    }else if ($choix==4){
        $nom='stim';
    }else if ($choix==5){
        $nom='colo';
    }
    $graphesChoix=graphesChoix($db,$nom);
    if (count($graphesChoix)==0){
        $data .= 0;
        $label .= 0;
    }else{
        for ($i=0;$i<count($graphesChoix);$i++){
            $data .= $graphesChoix[$i]['result'].",";
            $label .= "Test" .$i+1;
        }
    }
    $data.="]";
    $label.="]";
}
?>   
</html>
<script LANGUAGE='JavaScript'>
    dernierTest(<?php echo $datas; ?>,<?php echo $labels; ?>);
    resultatTest(<?php echo $choix; ?>,<?php echo "[" .implode(',',$data) ."]"; ?>,<?php echo $label; ?>,<?php echo $key; ?>);
    let value=/(?:^\?|&)choix=(\d+)/.exec(window.location.search);
	if (value!==null){
		document.querySelector('form.graphe select').selectedIndex = value[1];
	}
</script>






