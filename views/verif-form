<?php
try
{
 $bdd = new PDO("mysql:host=localhost;dbname=infinite_measures", "root", ""); 
 $bdd ->setAttribute(PDO::ATTR_ERRMODE,
 PDO::ERRMODE_EXCEPTION);
 }
 catch(Exception $e)
 {
  die("Une érreur a été trouvé : " . $e->getMessage());
 }
 $bdd
 if (isset($_GET["s"]) AND $_GET["s"] == "Rechercher")
{
 $_GET["terme"] = htmlspecialchars($_GET["terme"]);
 $terme = $_GET["terme'];
 $terme = trim($terme); 
 $terme = strip_tags($terme);
}
if (isset($terme))
{
 $terme = ucwords($terme);
 $select_terme = $infinite_measures->prepare("SELECT first_name, last_name FROM user
WHERE first_name LIKE ? OR last_name LIKE ?");
 $select_terme->execute(array("%".$terme."%", "%".$terme."%"));
}
else
{
 $message = "Vous devez entrer votre requete dans la barre de
recherche";
} 
}
?>
