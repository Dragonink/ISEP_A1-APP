<meta charset="utf-8" />
<?php
require "../models/connexionSQL.php";
$user = $bdd->prepare('SELECT first_name FROM user ORDER BY first_name DESC');
if(isset($_GET['q'])) {
   $q = htmlspecialchars($_GET['q']);
   $user = $bdd->prepare('SELECT first_name, last_name FROM user WHERE first_name LIKE "$q" ORDER BY first_name DESC');
   if($user->rowCount() == 0) {
      $user = $bdd->prepare('SELECT first_name, last_name FROM user WHERE CONCAT(first_name, last_name) LIKE "%'.$q.'%" ORDER BY first_name DESC');
   }
}
?>
<?php if($user->rowCount() > 0) { ?>
   <ul>
   <?php while($u = $user->fetch()) { ?>
      <li><?= $u['first_name'] ?></li>
   <?php } ?>
   </ul>
<?php } else { ?>
Aucun résultat pour: <?= $q ?>
<?php } ?>