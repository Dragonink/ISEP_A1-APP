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
