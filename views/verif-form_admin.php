<meta charset="utf-8" />
<?php
require "../models/connexionSQL.php";
$select_user = $bdd->query('SELECT first_name, last_name FROM user  UNION SELECT first_name, last_name FROM manager ORDER BY last_name DESC');
if(isset($_GET['recherche'])) {
   $q = htmlspecialchars($_GET['recherche']);
   $select_user = $bdd->query('SELECT first_name, last_name FROM user UNION SELECT first_name, last_name FROM user WHERE CONCAT(first_name, last_name) LIKE "%'.$q.'%" ORDER BY last_name DESC');
}
?>
   
<?php if($select_user->rowCount() > 0) { ?>
 <ul>
   <?php while($u = $select_user->fetch()) { ?>
      <li><?= $u['last_name'] ?></li>
   <?php } ?>
   </ul>
<?php } else { ?>
Aucun résultat pour: <?= $q ?>
<?php } ?>