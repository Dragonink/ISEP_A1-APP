<?php

include("requeteGenerique.php"); 

function nombreUtilisateur(PDO $db):int {
    $query = 'SELECT count(*) from administrator,user ,manager  where administrator.is_active=1 and manager.is_active=1';
    return $db->query($query)->fetchColumn();
}

function nombreTestsRealises(PDO $db):int {
    $query = 'SELECT count(*) from test';
    return $db->query($query)->fetchColumn();
}

function nombreRequete(PDO $db):int {
    $query = 'SELECT count(*) from administrator, manager  where administrator.is_active=0 and manager.is_active=0';
    return $db->query($query)->fetchColumn();
}

function nombreRequeteAdmin(PDO $db):int {
    $query = 'SELECT count(*) from administrator where administrator.is_active=0';
    return $db->query($query)->fetchColumn();
}

function nombreRequeteManager(PDO $db):int {
    $query = 'SELECT count(*) from manager where manager.is_active=0';
    return $db->query($query)->fetchColumn();
}

function nombreDispositif(PDO $db):int {
    $query = 'SELECT count(*) from console';
    return $db->query($query)->fetchColumn();
}

function infoDispositif(PDO $db) {
    $dispositif = 'SELECT console.id as code, first_name, last_name, work_adress, picture from manager join console on (console.manager=manager.id)';
    return $db->query($dispositif)->fetchAll();
}

function infoUtilisateur(PDO $db) {
    $dispositif = 'SELECT first_name, last_name, email, picture from administrator,user ,manager  where administrator.is_active=1 and manager.is_active=1';
    return $db->query($dispositif)->fetchAll();
}

?>
