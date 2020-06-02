<?php
require "connexionSQL.php";
function insertUser (PDO $db, $nss, $firstname, $lastname, $email, $password, $linked_manager) {
    $count = $db->query("SELECT COUNT(email) FROM user WHERE email = '$email'")->fetchColumn();
    $count += $db->query("SELECT COUNT(email) FROM manager WHERE email = '$email' AND is_active != -2")->fetchColumn();
    $count += $db->query("SELECT COUNT(email) FROM administrator WHERE email = '$email' AND is_active != -2")->fetchColumn();
    if ($count < 1){
        $password = password_hash($password, PASSWORD_DEFAULT);
        $req = $db->prepare("INSERT INTO user (nss, first_name, last_name, email, password, manager) VALUES ('$nss', '$firstname', '$lastname', '$email', '$password', '$linked_manager')");
        if ($req !== FALSE) {
            return $req->execute();
        }
    } else {
        setcookie("takenEmail", "true");
        return FALSE;
    }
}
function insertManager(PDO $db, $firstname, $lastname, $email, $password, $address) {
    $count = $db->query("SELECT COUNT(email) FROM user WHERE email = '$email'")->fetchColumn();
    $count += $db->query("SELECT COUNT(email) FROM manager WHERE email = '$email' AND is_active != -2")->fetchColumn();
    $count += $db->query("SELECT COUNT(email) FROM administrator WHERE email = '$email' AND is_active != -2")->fetchColumn();
    if ($count < 1) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $req = $db->prepare("INSERT INTO manager (first_name, last_name, email, password, work_address) VALUES ('$firstname', '$lastname', '$email', '$password', '$address')");
        if ($req !== FALSE) {
            return $req->execute();
        }
    } else {
        setcookie("takenEmail", "true");
        return FALSE;
    }
}
function insertAdmin(PDO $db, $firstname, $lastname, $email, $password, $is_active) {
    $count = $db->query("SELECT COUNT(email) FROM user WHERE email = '$email'")->fetchColumn();
    $count += $db->query("SELECT COUNT(email) FROM manager WHERE email = '$email' AND is_active != -2")->fetchColumn();
    $count += $db->query("SELECT COUNT(email) FROM administrator WHERE email = '$email' AND is_active != -2")->fetchColumn();
    if ($count < 1) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $req = $db->prepare("INSERT INTO administrator (first_name, last_name, email, password, is_active) VALUES ('$firstname', '$lastname', '$email', '$password', $is_active)");
        if ($req !== FALSE) {
            return $req->execute();
        }
    } else {
        setcookie("takenEmail", "true");
        return FALSE;
    }
}

function nbAdmin(PDO $db){
    $queryAdmin = 'SELECT count(*) from administrator where administrator.is_active=1';
    $prepareAdmin = $db->query($queryAdmin);
    $nbAdmin = $prepareAdmin->fetchColumn();
    return $nbAdmin;
}

function idAdmin(PDO $db){
    $queryAdmin = 'SELECT id from administrator where administrator.is_active=1';
    $prepareAdmin = $db->query($queryAdmin);
    $nbAdmin = $prepareAdmin->fetchColumn();
    return $nbAdmin;
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

function getConsolesByManager(PDO $db, $id) {
    $req = $db->query("SELECT id FROM console WHERE manager = '$id'");
    return $req->fetchAll(PDO::FETCH_COLUMN, 0);
}
