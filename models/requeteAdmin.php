<?php

require("connexionSQL.php");

function nombreUtilisateur(PDO $db):int {
    $queryAdmin = 'SELECT count(*) from administrator where administrator.is_active=1';
    $queryUser = 'SELECT count(*) from user';
    $queryMan = 'SELECT count(*) from manager where manager.is_active=1';
    $prepareAdmin = $db->query($queryAdmin);
    $nbAdmin = $prepareAdmin->fetchColumn();
    $prepareUser = $db->query($queryUser);
    $nbUser = $prepareUser->fetchColumn();
    $prepareMan = $db->query($queryMan);
    $nbMan = $prepareMan->fetchColumn();
    return ($nbAdmin + $nbUser + $nbMan);
}

function nombreTestsRealises(PDO $db):int {
    $query = 'SELECT count(*) from test';
    $prepare = $db->query($query);
    return $prepare->fetchColumn();
}

function nombreManager(PDO $db):int {
    $queryMan = 'SELECT count(*) from manager where manager.is_active=1';
    $prepareMan = $db->query($queryMan);
    return $prepareMan->fetchColumn();
}

function nombreRequete(PDO $db):int {
    $queryAdmin = 'SELECT count(*) from administrator where administrator.is_active=0';
    $queryMan = 'SELECT count(*) from manager where manager.is_active=0';
    $prepareAdmin = $db->query($queryAdmin);
    $nbAdmin = $prepareAdmin->fetchColumn();
    $prepareMan = $db->query($queryMan);
    $nbMan = $prepareMan->fetchColumn();
    return ($nbAdmin + $nbMan);
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
    $utilisateur = "SELECT id, first_name, last_name, email, NULL as picture, 'administrator' as origine from administrator where is_active=1 UNION SELECT nss as id, first_name, last_name, email, picture, 'user' as origine from user union SELECT id, first_name, last_name, email, picture, 'manager' as origine from manager  where is_active=1 ";
    $prepare = $db->prepare($utilisateur);
    $prepare->execute();
    return $prepare->fetchAll();
}

function infoManager(PDO $db) {
    $manager = "SELECT id, first_name, last_name from manager where is_active=1 ";
    $prepare = $db->prepare($manager);
    $prepare->execute();
    return $prepare->fetchAll();
}

function infoRequete(PDO $db) {
    $requete = "SELECT first_name, last_name, email, id, 'Administrateur' as origine from administrator where is_active=0 union all SELECT first_name, last_name, email, id, 'Médecin' as origine from manager  where is_active=0 ";
    $prepare = $db->prepare($requete);
    $prepare->execute();
    return $prepare->fetchAll();
}

function infoRequeteAdmin(PDO $db) {
    $requete = "SELECT first_name, last_name, email, id, 'Administrateur' as origine from administrator where is_active=0";
    $prepare = $db->prepare($requete);
    $prepare->execute();
    return $prepare->fetchAll();
}

function infoRequeteManager(PDO $db) {
    $requete = "SELECT first_name, last_name, email, id, 'Médecin' as origine from manager where is_active=0";
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

function rejeter(PDO $db,int $id, $origine) {
    $nomid='id';
    if ($origine =='Administrateur') {
        $origine='administrator';
    } elseif ($origine =='Médecin') {
        $origine='manager';
    }
    if ($origine =='user'){
        $nomid='nss';
    }
    if ($origine!='administrator'){
        $rejeter = "DELETE FROM " .$origine." WHERE " .$nomid ." = :id ";
        $prepare = $db->prepare($rejeter);
        $prepare->bindParam(':id', $id, PDO::PARAM_INT);
        $prepare->execute();
    } else {
        $rejeter ="UPDATE " .$origine ." SET is_active=-1 WHERE id =" .$id;
        $db->prepare($rejeter)->execute();
    }
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

function ajout(PDO $db){
    $modif ="INSERT INTO administrator(id, first_name, last_name, email, password, is_active) VALUES(1, 'Axelle', 'Martin', 'truc@gmail.com', 'truc', 1)";
    $coucou ="INSERT INTO administrator( first_name, last_name, email, password) VALUES('Axelle', 'Martin', 'axelle.martin@gmail.com', 'truc')";
    $db->prepare($modif)->execute();
    $db->prepare($coucou)->execute();
}

function ajoutDispositif(PDO $db,int $id, $manager){ //rajouter la vérification que le code n'est pas déjà utilisé
    $ajout ="INSERT INTO console( id, manager) VALUES(" .$id .", " .$manager .")";
    $db->prepare($ajout)->execute();
}

function bannir(PDO $db,int $id, $origine){
    rejeter($db,$id, $origine);
    if ($origin!='administartor'){
        $nomid='id';
        if ($origine =='user'){
            $nomid='nss';
        }
        $banni ="INSERT INTO banned( user) VALUES(" .$id .")";
        $db->prepare($banni)->execute();
    }
}

function validerRequete(PDO $db, int $id, $origine){
    if ($origine =='Administrateur') {
        $origine='administrator';
    } elseif ($origine =='Médecin') {
        $origine='manager';
    }
    $valider = "UPDATE " .$origine ." SET is_active=1 WHERE id =" .$id;
    $prepare = $db->prepare($valider);
    $prepare->execute();
}

?>
