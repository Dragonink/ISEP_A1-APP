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
    <script type="text/javascript" src="js/lib/RGraph.common.core.js"></script>
    <script type="text/javascript" src="js/lib/RGraph.common.dynamic.js"></script>
    <script type="text/javascript" src="js/lib/RGraph.bar.js"></script>
    <script type="text/javascript" src="js/lib/RGraph.line.js"></script>
    <script type="text/javascript" src="js/lib/RGraph.common.tooltips.js"></script>
    <script type="text/javascript" src="js/lib/RGraph.common.key.js"></script>
    <script type="text/javascript" src="js/lib/RGraph.drawing.yaxis.js"></script>

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
                        "<input type='number' name='console' placeholder='ID console' required />",
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
$max1=max($sfreq,$stona)+1;
$max2=max($stemp,$sstim,$scolo)+1;
$value="[" .$sfreq ."," .$stemp ."," .$stona ."," .$sstim ."," .$scolo ."]";
$datas="[" .$sfreq/$max1 ."," .$stemp/$max2 ."," .$stona/$max1 ."," .$sstim/$max2 ."," .$scolo/$max2 ."]";
$labels="['Fréquence (bpm)','Température (°C)', 'Tonalité (Hz)', 'Stimuli (s)', 'Simon (/20)']";

$choix=$_GET['choix'];
$label='[';
$key="''";
$nbExam=nbExam($db)[0][0];
$utilisateurTest2=utilisateurTest2($db);
if ($nbExam==0){
    $data.="[0]";
    $label.="'Aucun test a été réalisé'";
    $lfreq[0]=0;
    $ltemp[0]=0;
    $ltona[0]=0;
    $lstim[0]=0;
    $lcolo[0]=0;
}else {
    $var=0;
    $num=0;
    $num1=0;
    for ($i=0; $i<$nbExam; $i++){
        $lfreq[$i]=0;
        $ltemp[$i]=0;
        $ltona[$i]=0;
        $lstim[$i]=0;
        $lcolo[$i]=0;
        for ($j=$num; $j<count($utilisateurTest2);$j++){
            if ((($j==$num) || ($utilisateurTest2[$j]['exam']==$var)) && $utilisateurTest2[$j]!=null){
                if ($utilisateurTest2[$j]['type']=='freq'){
                    $lfreq[$i] = $utilisateurTest2[$j]['result'];
                }elseif ($utilisateurTest2[$j]['type']=='temp'){
                    $ltemp[$i] = $utilisateurTest2[$j]['result'];
                    $var=$utilisateurTest2[$j]['exam'];
                    $utilisateurTest2[$j]=null;
                }elseif ($utilisateurTest2[$j]['type']=='tona'){
                    $ltona[$i] = $utilisateurTest2[$j]['result'];
                    $var=$utilisateurTest2[$j]['exam'];
                    $utilisateurTest2[$j]=null;
                }elseif ($utilisateurTest2[$j]['type']=='stim'){
                    $lstim[$i] = $utilisateurTest2[$j]['result'];
                    $var=$utilisateurTest2[$j]['exam'];
                    $utilisateurTest2[$j]=null;
                }elseif ($utilisateurTest[$j]['type']=='colo'){
                    $lcolo[$i] = $utilisateurTest2[$j]['result'];
                    $var=$utilisateurTest2[$j]['exam'];
                    $utilisateurTest2[$j]=null;
                }
                $num1=$j+1;
            }
        }
        $num=$num1;
        $nb=$i+1;
        $label .= "'Examen n°" .$nb ."'";
        if ($i<($nbExam-1)){
            $label.=",";
        }
    }
}
$maxi1=1;
$maxi2=1;
if ($choix==0){
    $maxi1=max(max($lfreq),max($ltona))+1;
    $maxi2=max(max($ltemp),max($lstim),max($lcolo))+1;
    for ($div=0;$div<count($lfreq);$div++){
        $lfreq[$div]=$lfreq[$div]/$maxi1;
        $ltemp[$div]=$ltemp[$div]/$maxi2;
        $ltona[$div]=$ltona[$div]/$maxi1;
        $lstim[$div]=$lstim[$div]/$maxi2;
        $lcolo[$div]=$lcolo[$div]/$maxi2;
    }
    $data[0]="[" .implode(',',$lfreq) ."]";
    $data[1]="[" .implode(',',$ltemp) ."]";
    $data[2]="[" .implode(',',$ltona) ."]";
    $data[3]="[" .implode(',',$lstim) ."]";
    $data[4]="[" .implode(',',$lcolo) ."]";
    $key="['Fréquence (bpm)','Température (°C)', 'Tonalité (Hz)', 'Stimuli (s)', 'Simon (/20)']";
    if ($data=="[[[[["){
        $data="[[0],[0],[0],[0],[0]]";
    }else{
        $data="[" .implode(',',$data) ."]";
    }
    $unit="['bpm','°C', 'Hz', 's', '/20']";
}else{
    if ($choix==1){
        $data="[" .implode(',',$lfreq) ."]";
        $unit="'bpm'";
    }else if ($choix==2){
        $data="[" .implode(',',$ltemp) ."]";
        $unit="'°C'";
    }else if ($choix==3){
        $data="[" .implode(',',$ltona) ."]";
        $unit="'Hz'";
    }else if ($choix==4){
        $data="[" .implode(',',$lstim) ."]";
        $unit="'s'";
    }else if ($choix==5){
        $data="[" .implode(',',$lcolo) ."]";
        $unit="'/20'";
    }
}
$label.="]";
?>
<script LANGUAGE='JavaScript'>
    dernierTest(<?php echo $datas; ?>,<?php echo $labels; ?>, <?php echo $max1; ?>, <?php echo $max2; ?>);
    resultatTest(<?php echo $choix; ?>,<?php echo $data; ?>,<?php echo $label; ?>,<?php echo $key; ?>,<?php echo $unit; ?>,<?php echo $maxi1; ?>, <?php echo $maxi2; ?>);
    let value=/(?:^\?|&)choix=(\d+)/.exec(window.location.search);
	if (value!==null){
		document.querySelector('form.graphe select').selectedIndex = value[1];
	}
</script>
</html>
