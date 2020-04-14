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

function nombreQuestion(PDO $db):int {
    $query = 'SELECT count(*) from faq';
    return $db->query($query)->fetchColumn();
}

function infoDispositif(PDO $db) {
    $dispositif = 'SELECT console.id as code, first_name, last_name, work_adress, picture from manager join console on (console.manager=manager.id)';
    return $db->query($dispositif)->fetchAll();
}

function infoUtilisateur(PDO $db) {
    $utilisateur = "SELECT first_name, last_name, email, picture, 'administrator' as origine from administrator union all SELECT first_name, last_name, email, picture, 'user' as origine from user, union all SELECT first_name, last_name, email, picture, 'manager' as origine from manager  where is_active=1 ";
    return $db->query($utilisateur)->fetchAll();
}

function infoRequete(PDO $db) {
    $requete = "SELECT first_name, last_name, email, id, 'administrateur' as origine from administrator union all SELECT first_name, last_name, email, id, 'médecin' as origine from manager  where is_active=0 ";
    return $db->query($requete)->fetchAll();
}

function infoRequeteAdmin(PDO $db) {
    $requete = "SELECT first_name, last_name, email, id, 'administrateur' as origine from administrator where is_active=0";
    return $db->query($requete)->fetchAll();
}

function infoRequeteManager(PDO $db) {
    $requete = "SELECT first_name, last_name, email, id, 'médecin' as origine from manager where is_active=0";
    return $db->query($requete)->fetchAll();
}

function infoFaq(PDO $db) {
    $FAQ = 'SELECT id, question, answer, first_name, last_name from faq join manager where faq.admin=manager.id' ;
    return $db->query($FAQ)->fetchAll();
}

function rejeter(PDO $db, $id, $origine) {
    if ($origine == 'administrateur') {
        $origine='administrator';
    } elseif ($origine == 'médecin') {
        $origine='manager';
    }
    $rejeter = "DELETE FROM :origine WHERE id=:id ";
    $db->prepare($rejeter)->execute(array('origine' => $origine, 'id' => $id ));
}

function ajoutQuestion(PDO $db, $question, $answer) {
    $question = 'INSERT INTO faq(question, answer, admin) VALUES(:question, :answer, :admin');

    $db->prepare($question)->execute(array(
        'question' => $question,
        'answer' => $answer,
        'admin' => $_SESSION['id'],
	));
}

?>
