<?php
require "connexionSQL.php";

function insertUser($nss, $firstname, $lastname, $email, $password, $linked_manager) {
    return $db->prepare("INSERT INTO user(nss, first_name, last_name, email, manager) VALUES ($nss, $firstname, $lastname, $email, ?, $linked_manager)")->execute([password_hash($password)]);
}
function insertManager($firstname, $lastname, $email, $password, $address) {
    return $db->prepare("INSERT INTO manager(first_name, last_name, email, password, work_address) VALUES ($firstname, $lastname, $email, ?, $address)")->execute([password_hash($password)]);
}
function insertAdmin($firstname, $lastname, $email, $password) {
    return $db->prepare("INSERT INTO administrator(first_name, last_name, email, password) VALUES ($firstname, $lastname, $email, ?)")->execute([password_hash($password)]);
}

function fetchUser($nss) {
    return $db->query("SELECT * FROM user WHERE nss = $nss")->fetch(PDO::FETCH_ASSOC);
}
function fetchManager($email) {
    return $db->query("SELECT * FROM manager WHERE email = $email")->fetch(PDO::FETCH_ASSOC);
}
function fetchAdmin($email) {
    return $db->query("SELECT * FROM administrator WHERE email = $email")->fetch(PDO::FETCH_ASSOC);
}
