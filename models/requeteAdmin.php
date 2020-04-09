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
    $query = 'SELECT count(*) from administrator,manager  where administrator.is_active=0 and manager.is_active=0';
    return $db->query($query)->fetchColumn();
}

function nombreRequeteAdmin(PDO $db):int {
    $query = 'SELECT count(*) from administrator  where administrator.is_active=0';
    return $db->query($query)->fetchColumn();
}

function nombreRequeteManager(PDO $db):int {
    $query = 'SELECT count(*) from manager where manager.is_active=0';
    return $db->query($query)->fetchColumn();
}

?>