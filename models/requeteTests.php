<?php
require "connexionSQL.php";

function getExamId(PDO $db, $user) {
    $req = $db->query("SELECT MAX(id) FROM exam WHERE user = '$user' AND console = NULL");
    return $req->fetchAll();
}
function getTests(PDO $db, $exam) {
    $req = $db->query("SELECT type FROM test WHERE exam = '$exam'");
    return $req->fetchAll();
}
function declareTests(PDO $db, $user, $tests) {
    $req = $db->prepare("INSERT INTO exam (user) VALUES ('$user')");
    if ($req !== FALSE) {
        $req->execute();
        $exam = getExamId($db, $user);
        foreach ($tests as $test) {
            $req = $db->prepare("INSERT INTO test (exam, type) VALUES ('$exam', '$test')");
            if ($req !== FALSE) {
                $req->execute();
            }
        }
    }
}
