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
</html>
<?php
$sfreq=0;
$stemp=0;
$stona=0;
$sstim=0;
$scolo=0;

for ($i=0; $i<count(utilisateurTest($db)); $i++){
    if (utilisateurTest($db)[$i]['type']=='freq'){
        $sfreq = utilisateurTest($db)[$i]['result'];
    }elseif (utilisateurTest($db)[$i]['type']=='temp'){
        $stemp = utilisateurTest($db)[$i]['result'];
    }elseif (utilisateurTest($db)[$i]['type']=='tona'){
        $stona = utilisateurTest($db)[$i]['result'];
    }elseif (utilisateurTest($db)[$i]['type']=='stim'){
        $sstim= utilisateurTest($db)[$i]['result'];
    }elseif (utilisateurTest($db)['type']=='colo'){
        $scolo = utilisateurTest($db)[$i]['result'];
    }
}
$datas="[" .$sfreq ."," .$stemp ."," .$stona ."," .$sstim ."," .$scolo ."]";
$labels="['Fréquence','Température', 'Tonalités', 'Stimuli' , 'Simon' ]";

$choix=$_GET['choix'];
$lfreq='[';
$ltemp='[';
$ltona='[';
$lstim='[';
$lcolo='[';
$label='[';
$data='[';
$key='';
if ($choix==0){
    if (count(nbExam($db))==0){
        $data.="[0]";
        $label.="'Aucun test a été réalisé'";
    }else {
        for ($i=0; $i<count(nbExam($db)); $i++){
            $Exam[$i]= '[';
            for ($j=0; $j<count(utilisateurTest2($db));$j++){
                $lfreqExam = 0;
                $ltempExam = 0;
                $ltonaExam = 0;
                $lstimExam = 0;
                $lcoloEXam = 0;
                if ($j==0){
                    if (utilisateurTest($db)[$i]['type']=='freq'){
                        $lfreqExam = utilisateurTest2($db)[$i]['result'];
                    }elseif (utilisateurTest2($db)[$i]['type']=='temp'){
                        $ltempExam = utilisateurTest2($db)[$i]['result'];
                    }elseif (utilisateurTest2($db)[$i]['type']=='tona'){
                        $ltonaExam = utilisateurTest2($db)[$i]['result'];
                    }elseif (utilisateurTest2($db)[$i]['type']=='stim'){
                        $lstimExam = utilisateurTest2($db)[$i]['result'];
                    }elseif (utilisateurTest2($db)['type']=='colo'){
                        $lcoloEXam = utilisateurTest2($db)[$i]['result'];
                    }
                }elseif(utilisateurTest2($db)[$j]['exam.id']==utilisateurTest2($db)[$j-1]['exam.id']){
                    if (utilisateurTest2($db)[$i]['type']=='freq'){
                        $lfreqExam = utilisateurTest2($db)[$i]['result'];
                    }elseif (utilisateurTest2($db)[$i]['type']=='temp'){
                        $ltempExam = utilisateurTest2($db)[$i]['result'];
                    }elseif (utilisateurTest2($db)[$i]['type']=='tona'){
                        $ltonaExam = utilisateurTest2($db)[$i]['result'];
                    }elseif (utilisateurTest($db)[$i]['type']=='stim'){
                        $lstimExam = utilisateurTest2($db)[$i]['result'];
                    }elseif (utilisateurTest2($db)['type']=='colo'){
                        $lcoloEXam = utilisateurTest2($db)[$i]['result'];
                    }
                }
            }
            $lfreq.=$lfreqExam;
            $ltemp.=$ltempExam;
            $ltona.=$ltonaExam;
            $lstim.=$lstimExam;
            $lcolo.=$lcoloExam;
            $Exam[$i]= "[".$lfreqExam ."," .$ltempExam ."," .$ltonaExam ."," .$lstimExam ."," .$lcoloExam ."]";
            $key="['Fréquence','Température', 'Tonalités', 'Stimuli' , 'Simon' ]";
            $data.=$Exam[$i];
            $label .= "Exam.strval( $i+1)";;

            if ($i<(count(nbExam($db)-1))){
                $lfreq.=",";
                $ltemp.=",";
                $ltona.=",";
                $lstim.=",";
                $lcolo.=",";
            }
        }
        $lfreq.="]";
        $ltemp.="]";
        $ltona.="]";
        $lstim.="]";
        $lcolo.="]";
        if ($i<(count(nbExam($db)-1))){
            $label.=",";
            $data.=",";
        }
    }
    $label.="]";
    $data.="]";
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
    if (count(graphesChoix($db,$nom))==0){
        $data .= 0;
        $label .= 0;
    }else{
        for ($i=0;$i<count(graphesChoix($db,$nom));$i++){
            $data .= graphesChoix($db,$nom)[$i]['result'].",";
            $label .= "Test.strval( $i+1)";
        }
    }
    $data.="]";
    $label.="]";
}
 ?>   

<script LANGUAGE='JavaScript'>
    dernierTest(<?php echo $datas; ?>,<?php echo $labels; ?>);
    resultatTest(<?php echo $choix; ?>,<?php echo $data; ?>,<?php echo $label; ?>,<?php echo $key; ?>);
    let value=/(?:^\?|&)choix=(\d+)/.exec(window.location.search);
	if (value!==null){
		document.querySelector('form.graphe select').selectedIndex = value[1];
	}
</script>






