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

function nombreUtilisateurRecherche(PDO $db, $recherche) {
    $queryAdmin = "SELECT count(*) from administrator where is_active=1 and (first_name like '%".$recherche."%' or last_name like '%".$recherche."%')";
    $queryUser = "SELECT count(*) from user where first_name like '%".$recherche."%' or last_name like '%".$recherche."%' or nss like '%".$recherche."%'";
    $queryMan = "SELECT count(*) from manager where is_active=1 and (first_name like '%".$recherche."%' or last_name like '%".$recherche."%')";
    $prepareAdmin = $db->query($queryAdmin);
    $nbAdmin = $prepareAdmin->fetchColumn();
    $prepareUser = $db->query($queryUser);
    $nbUser = $prepareUser->fetchColumn();
    $prepareMan = $db->query($queryMan);
    $nbMan = $prepareMan->fetchColumn();
    return ($nbAdmin + $nbUser + $nbMan);
}

function nombreTestsRealises(PDO $db):int {
    $query = 'SELECT count(*) from test where result IS NOT NULL';
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
    $query = 'SELECT count(*) from console where is_active=1';
    $prepare = $db->query($query);
    return $prepare->fetchColumn();
}

function nombreDispositifRecherche(PDO $db, $recherche){
    $query = "SELECT count(*) from console join manager on (console.manager=manager.id) where console.id like '%".$recherche."%' or manager.last_name like '%".$recherche."%' and console.is_active=1";
    $prepare = $db->query($query);
    return $prepare->fetchColumn();
}

function nombreQuestion(PDO $db):int {
    $query = 'SELECT count(*) from faq';
    $prepare = $db->query($query);
    return $prepare->fetchColumn();
}

function infoDispositif(PDO $db, $value) {
    switch ($value){
        case 0:
            $dispositif = 'SELECT console.id as code, first_name, last_name, work_address from manager join console on (console.manager=manager.id) where console.is_active=1 order by console.id ';
        break;

        case 1:
            $dispositif = 'SELECT console.id as code, first_name, last_name, work_address from manager join console on (console.manager=manager.id) where console.is_active=1 order by console.id desc' ;
        break;

        case 2:
            $dispositif = 'SELECT console.id as code, first_name, last_name, work_address from manager join console on (console.manager=manager.id) where console.is_active=1 order by manager.last_name  ' ;
        break;

        case 3:
            $dispositif = 'SELECT console.id as code, first_name, last_name, work_address from manager join console on (console.manager=manager.id) where console.is_active=1 order by manager.work_address  ' ;
        break;
    }
    $prepare = $db->prepare($dispositif);
    $prepare->execute();
    return $prepare->fetchAll();
}

function infoDispositifRecherche(PDO $db, $value, $recherche) {
    switch ($value){
        case 0:
            $dispositif = "SELECT console.id as code, first_name, last_name, work_address  from manager join console on (console.manager=manager.id) where console.id like '%".$recherche."%' or manager.last_name like '%".$recherche."%' and console.is_active=1 order by console.id " ;
        break;

        case 1:
            $dispositif = "SELECT console.id as code, first_name, last_name, work_address from manager join console on (console.manager=manager.id) where console.id like '%".$recherche."%' or manager.last_name like '%".$recherche."%' and console.is_active=1 order by console.id desc ";
        break;

        case 2:
            $dispositif = "SELECT console.id as code, first_name, last_name, work_address from manager join console on (console.manager=manager.id) where console.id like '%".$recherche."%' or manager.last_name like '%".$recherche."%' and console.is_active=1 order by manager.last_name " ;

        break;
        case 3:
            $dispositif = "SELECT console.id as code, first_name, last_name, work_address from manager join console on (console.manager=manager.id) where console.id like '%".$recherche."%' or manager.last_name like '%".$recherche."%' and console.is_active=1 order by manager.work_address " ;
        break;
    }
    $prepare = $db->prepare($dispositif);
    $prepare->execute();
    return $prepare->fetchAll();

}

function infoUtilisateur(PDO $db, $value) {
    $utilisateur = "SELECT id, first_name, last_name, email, 'administrator' as origine from administrator where is_active=1 UNION SELECT nss as id, first_name, last_name, email, 'user' as origine from user union SELECT id, first_name, last_name, email, 'manager' as origine from manager  where is_active=1 order by ";
    switch($value){
        case 0:
            $utilisateur .= "id";
            break;
        case 1:
            $utilisateur .= "id desc";
            break;
        case 2:
            $utilisateur .= "origine";
            break;
        case 3:
            $utilisateur .= "last_name";
            break;
        case 4:
            $utilisateur .= "first_name";
            break;
    }
    $prepare = $db->prepare($utilisateur);
    $prepare->execute();
    return $prepare->fetchAll();
}

function infoUtilisateurRecherche(PDO $db, $value, $recherche) {
    $utilisateur = "SELECT id, first_name, last_name, email, 'administrator' as origine from administrator where is_active=1 and (first_name like '%".$recherche."%' or last_name like '%".$recherche."%') UNION SELECT nss as id, first_name, last_name, email, 'user' as origine from user where first_name like '%".$recherche."%' or last_name like '%".$recherche."%' or nss like '%".$recherche."%' union SELECT id, first_name, last_name, email, 'manager' as origine from manager  where is_active=1 and (first_name like '%".$recherche."%' or last_name like '%".$recherche."%') order by ";
    switch ($value){
        case 0:
            $utilisateur .= "id";
            break;
        case 1;
            $utilisateur .= "id desc";
            break;
        case 2:
            $utilisateur .= "origine";
            break;
        case 3:
            $utilisateur .= "last_name";
            break;
        case 4:
            $utilisateur .= "first_name";
            break;
    }
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
        $rejeter = "UPDATE " .$origine." set is_active=-2 WHERE " .$nomid ." = :id ";
    } elseif ($origine =='Médecin') {
        $origine='manager';
        $rejeter = "UPDATE " .$origine." set is_active=-2 WHERE " .$nomid ." = :id ";
    } elseif ($origine =='user'){
        $nomid='nss';
        $rejeter = "DELETE FROM " .$origine." WHERE " .$nomid ." = :id ";
    }
    $prepare = $db->prepare($rejeter);
    $prepare->bindParam(':id', $id, PDO::PARAM_INT);
    $prepare->execute();
}

function ajoutQuestion(PDO $db, $question, $answer, $admin) {
    $ajout = 'INSERT INTO faq(question, answer, admin) VALUES(:question, :answer, :admin)';
    $prepare = $db->prepare($ajout);
    $prepare->execute(array(
        'question' => $question,
        'answer' => $answer,
        'admin' => $admin,
    ));
}

function supQuestion(PDO $db, $id) {
    $sup = "DELETE FROM faq WHERE id= :id";
    $prepare = $db->prepare($sup);
    $prepare->bindParam(':id', $id, PDO::PARAM_INT);
    $prepare->execute();
}

function modifQuestion(PDO $db, $id, $question, $answer, $admin) {
    $modif = 'UPDATE faq SET question = :question, answer = :answer, admin = :admin WHERE id = :id';
    $prepare = $db->prepare($modif);
    $prepare->execute(array(
        'question' => $question,
        'answer' => $answer,
        'admin' => $admin,
        'id' => $id,
    ));
}

function nbIdDispositif(PDO $db){
    $query = 'SELECT count(*) from console where is_active=0';
    $prepare = $db->query($query);
    return $prepare->fetchColumn();
}

function idDispositif(PDO $db) {
    $query = 'SELECT id from console where is_active=0';
    $prepare = $db->query($query);
    return $prepare->fetchColumn();
}

function ajoutDispositif(PDO $db,int $id, $manager){
    if (preg_match("/^\d{6}$/", $id) === 1) {
        $ajout ="INSERT INTO console( id, manager) VALUES(" .$id .", " .$manager .")";
        $db->prepare($ajout)->execute();
    }
}

function ajoutDispositif1(PDO $db,int $id, $manager){
    $ajout ="UPDATE console set is_active=1, manager=" .$manager." WHERE id=" .$id;
    $db->prepare($ajout)->execute();
}

function supDispositif(PDO $db,int $id){
    $sup = "UPDATE console set is_active=0 WHERE id= :id ";
    $prepare = $db->prepare($sup);
    $prepare->bindParam(':id', $id, PDO::PARAM_INT);
    $prepare->execute();
}

function bannir(PDO $db,int $id, $origine){
    rejeter($db,$id, $origine);
    $nomid='id';
    if ($origine=='user'){
        $nomid='nss';
        $banni ="INSERT INTO banned( user) VALUES(" .$id .")";
        $db->prepare($banni)->execute();
    } else {
        $rejeter ="UPDATE " .$origine ." SET is_active=-1 WHERE id =" .$id;
        $db->prepare($rejeter)->execute();
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

function testInfo(PDO $db){
    $test = "SELECT type, COUNT(type) as nb FROM test where result IS NOT NULL GROUP BY type";
    $prepare = $db->prepare($test);
    $prepare->execute();
    return $prepare->fetchAll();
}
