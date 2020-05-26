<?php
require "connexionSQL.php";

function getExamId(PDO $db, $user) {
    $req = $db->query("SELECT MAX(id) as id FROM exam WHERE user = '$user' AND console is NULL");
    return $req->fetchAll();
}
function getTests(PDO $db, $exam) {
    $req = $db->query("SELECT type FROM test WHERE exam = '$exam'");
    return $req->fetchAll(PDO::FETCH_COLUMN, 0);
}
function declareTests(PDO $db, $user, $tests) {
    $req = $db->prepare("INSERT INTO exam (user) VALUES ('$user')");
    if ($req !== FALSE) {
        $req->execute();
        $exam = getExamId($db, $user)[0]["id"];
        foreach ($tests as $test) {
            $req = $db->prepare("INSERT INTO test (exam, type) VALUES ('$exam', '$test')");
            if ($req !== FALSE) {
                $req->execute();
            }
        }
    }
}
function saveConsole(PDO $db, $exam, $console) {
    $req = $db->prepare("UPDATE exam SET console = '$console' WHERE id = '$exam'");
    if ($req !== FALSE) {
        $req->execute();
    }
}

function saveTests(PDO $db, $exam, $tests) {
    foreach ($tests as $test => $value) {
        if ($value  !=  null) {
            $req = $db->prepare("UPDATE test SET result = '$value' WHERE exam = '$exam' AND type = '$test'");
            if ($req !== FALSE) {
                $req->execute();
            }
        }
    }
}

function utilisateurTest(PDO $db){
    $test="SELECT  type,result from test where ((test.exam==exam.id) && (exam.user==" .$_SESSION['user_id'] .")) && result IS NOT NULL";
    $prepare = $db->prepare($test);
    $prepare->execute();
    return $prepare->fetchAll();
}

function utilisateurTest2(PDO $db){
    $test="SELECT  type, result, exam from test where ((test.exam==exam.id) && (exam.user==" .$_SESSION['user_id'] .")) && result IS NOT NULL"  ;
    $prepare = $db->prepare($test);
    $prepare->execute();
    return $prepare->fetchAll();
}

function nbExam(PDO $db){
    $nb = "SELECT count(DISTINCT exam.id) from test  where ((test.exam==exam.id) && (exam.user==" .$_SESSION['user_id'] .")) && result IS NOT NULL order by exam.id";
    $prepare = $db->prepare($nb);
    $prepare->execute();
    return $prepare->fetchAll();
}

function graphesChoix(PDO $db,$type){
    $nb = "SELECT type,result from test  where ((test.type ==$type ) && (test.exam==exam.id) && (exam.user==" .$_SESSION['user_id'] .")) && result IS NOT NULL order by exam.id";
    $prepare = $db->prepare($nb);
    $prepare->execute();
    return $prepare->fetchAll();

}


