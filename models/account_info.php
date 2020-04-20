<?php
require "connexionSQL.php";
function insertUser(PDO $db, $nss, $firstname, $lastname, $email, $password, $linked_manager) {
    $password = password_hash($password, PASSWORD_DEFAULT);
    $req = $db->prepare("INSERT INTO user (nss, first_name, last_name, email, password, manager) VALUES ('$nss', '$firstname', '$lastname', '$email', '$password', '$linked_manager')");
    if ($req !== FALSE) {
        return $req->execute();
    }
}
function insertManager(PDO $db, $firstname, $lastname, $email, $password, $address) {
    $password = password_hash($password, PASSWORD_DEFAULT);
    $req = $db->prepare("INSERT INTO manager (first_name, last_name, email, password, work_address) VALUES ('$firstname', '$lastname', '$email', '$password', '$address')");
    if ($req !== FALSE) {
        return $req->execute();
    }
}
function insertAdmin(PDO $db, $firstname, $lastname, $email, $password) {
    $password = password_hash($password, PASSWORD_DEFAULT);
    $req = $db->prepare("INSERT INTO administrator (first_name, last_name, email, password) VALUES ('$firstname', '$lastname', '$email', '$password')");
    if ($req !== FALSE) {
        return $req->execute();
    }
}

function fetchUser(PDO $db, $nss) {
    $req = $db->query("SELECT * FROM user WHERE nss = '$nss' ");
    return $req->fetchAll();
}
function fetchUser2(PDO $db, $email) {
    $req = $db->query("SELECT * FROM user WHERE email = '$email' ");
    return $req->fetchAll();
}
function fetchManager(PDO $db, $email) {
    $req = $db->query("SELECT * FROM manager WHERE email = '$email' ");
    return $req -> fetchAll();
}
function fetchManager2(PDO $db, $id) {
    $req = $db->query("SELECT * FROM manager WHERE id = '$id' ");
    return $req -> fetchAll();
}
function fetchAdmin(PDO $db, $email) {
    $req = $db->query("SELECT * FROM administrator WHERE email = '$email' ");
    return $req->fetchAll();
}