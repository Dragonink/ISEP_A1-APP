<?php

include("requeteGenerique.php"); 

function nombreUtilisateur(PDO $db):int {
    $query = 'SELECT count(*) from administrator, user ,manager  where administrator.is_active=1 and manager.is_active=1';
    $prepare = $db->query($query);
    return $prepare->fetchColumn();
}

function nombreTestsRealises(PDO $db):int {
    $query = 'SELECT count(*) from test';
    $prepare = $db->query($query);
    return $prepare->fetchColumn();
}

function nombreRequete(PDO $db):int {
    $query = 'SELECT count(*) from administrator, manager  where administrator.is_active=0 and manager.is_active=0';
    $prepare = $db->query($query);
    return $prepare->fetchColumn();
}

function nombreRequeteAdmin(PDO $db):int {
    $query = 'SELECT count(*) from administrator where administrator.is_active=0';
    $prepare = $db->query($query);
    return $prepare->fetchColumn();
}

function nombreRequeteManager(PDO $db):int {
    $query = 'SELECT count(*) from manager where manager.is_active=0';
    $prepare = $db->query($query);
    return $prepare->fetchColumn();
}

function nombreDispositif(PDO $db):int {
    $query = 'SELECT count(*) from console';
    $prepare = $db->query($query);
    return $prepare->fetchColumn();
}

function nombreQuestion(PDO $db):int {
    $query = 'SELECT count(*) from faq';
    $prepare = $db->query($query);
    return $prepare->fetchColumn();
}

function infoDispositif(PDO $db) {
    $dispositif = 'SELECT console.id as code, first_name, last_name, work_adress, picture from manager join console on (console.manager=manager.id)';
    $prepare = $db->prepare($dispositif);
    $prepare->execute();
    return $prepare->fetchAll();
}

function infoUtilisateur(PDO $db) {
    $utilisateur = "SELECT first_name, last_name, email, picture, 'administrator' as origine from administrator union all SELECT first_name, last_name, email, picture, 'user' as origine from user, union all SELECT first_name, last_name, email, picture, 'manager' as origine from manager  where is_active=1 ";
    $prepare = $db->prepare($utilisateur);
    $prepare->execute();
    return $prepare->fetchAll();
}

function infoRequete(PDO $db) {
    $requete = "SELECT first_name, last_name, email, id, 'administrateur' as origine from administrator union all SELECT first_name, last_name, email, id, 'médecin' as origine from manager  where is_active=0 ";
    $prepare = $db->prepare($requete);
    $prepare->execute();
    return $prepare->fetchAll();
}

function infoRequeteAdmin(PDO $db) {
    $requete = "SELECT first_name, last_name, email, id, 'administrateur' as origine from administrator where is_active=0";
    $prepare = $db->prepare($requete);
    $prepare->execute();
    return $prepare->fetchAll();
}

function infoRequeteManager(PDO $db) {
    $requete = "SELECT first_name, last_name, email, id, 'médecin' as origine from manager where is_active=0";
    $prepare = $db->prepare($requete);
    $prepare->execute();
    return $prepare->fetchAll();
}

function infoFaq(PDO $db) {
    $FAQ = "SELECT faq.id as id, question, answer, first_name, last_name from faq LEFT JOIN administrator ON faq.admin=administrator.id" ;
    $prepare = $db->prepare($FAQ);
    $prepare->execute();
    return $prepare->fetchAll();
}

function rejeter(PDO $db, $id, $origine) {
    if ($origine == 'administrateur') {
        $origine='administrator';
    } elseif ($origine == 'médecin') {
        $origine='manager';
    }
    $rejeter = "DELETE FROM :origine WHERE id=:id ";
    $prepare = $db->prepare($rejeter);
    $prepare->execute(array('origine' => $origine, 'id' => $id ));
}

function ajoutQuestion(PDO $db, $question, $answer) {
    $ajout = 'INSERT INTO faq(question, answer, admin) VALUES(:question, :answer, :admin)';
    $prepare = $db->prepare($ajout);
    $prepare->execute(array(
        'question' => $question,
        'answer' => $answer,
        'admin' => 1,
    ));
}

function supQuestion(PDO $db, $id) {
    $sup = "DELETE FROM faq WHERE id= :id";
    $prepare = $db->prepare($sup);
    $prepare->bindParam(':id', $id, PDO::PARAM_INT);
    $prepare->execute();
}

function modifQuestion(PDO $db, $id, $question, $answer) {
    $modif = 'UPDATE faq SET question = :question, answer = :answer, admin = :admin WHERE id = :id';
    $prepare = $db->prepare($modif);
    $prepare->execute(array(
        'question' => $question,
        'answer' => $answer,
        'admin' => 1,
        'id' => $id,
    ));
}

?>