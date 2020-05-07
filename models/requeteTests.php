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
