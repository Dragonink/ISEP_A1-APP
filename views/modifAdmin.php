<?php
session_start(); 
require "../models/account_info.php";
if (isset($_GET['email'])){
    $user_info = fetchAdmin($db, $_GET['email']);
    if ($_SESSION["user_email"]!=$user_info[0]["email"]){
        $user["prenom"]=$user_info[0]["first_name"];
        $user["nom"]=$user_info[0]["last_name"];
        $user["email"]=$user_info[0]["email"];
        $user["id"]=$user_info[0]["id"];
    } else {
        $user["prenom"]=$_SESSION["user_prenom"];
        $user["nom"]=$_SESSION["user_nom"];
        $user["email"]=$_SESSION["user_email"];
        $user["id"]=$_SESSION["user_id"];
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <!-- JS -->
    <script src="js/admin.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

    <!-- CSS -->
    <link href="css/admin.css" rel="stylesheet" type="text/css">
    <link href="css/header-footer.css" rel="stylesheet" type="text/css">

</head>

<body>
    <?php require "_header.php"; ?>
    <section id="contenuAdmin">
        <form class="modificationProfil" method="POST" action ="modif.php">
            <h2>Modification profil</h2></br>
            <table>
                <tr>
                    <td>
                        <p>Nom</p>
                    </td>
                    <td><input type="text" name="nom" placeholder="<?php echo $user["nom"]?>" /></td>
                </tr>
                <tr>
                    <td>
                        <p>Prénom</p>
                    </td>
                    <td><input type="text" name="prenom" placeholder="<?php echo $user["prenom"]?>" /></td>
                </tr>
                <tr>
                    <td>
                        <p>E-mail</p>
                    </td>
                    <td><input type="email" name="email" placeholder="<?php echo $user["email"]?>" /></td>
                </tr>
                <tr>
                    <td>
                        <p>Vérification e-mail</p>
                    </td>
                    <td><input type="email" name="verifemail" /></td>
                </tr>
                <?php if (!isset($_GET['email'])){
                    echo "<tr>",
                            "<td>",
                                "<p>Mot de passe</p>",
                            "</td>",
                            "<td><input type=\"text\" name=\"mdp\" /></td>",
                        "</tr>",
                        "<tr>",
                            "<td>",
                                "<p>Vérification mot de passe</p>",
                            "</td>",
                            "<td><input type=\"text\" name=\"verifmdp\" /></td>",
                        "</tr>";
                }?>
            </table>
            <input type="hidden" name="id" value="<?php echo $user["id"]?>"/>
            <div class="boutons">
                <button type="submit" id="annuler" name="annuler"> Annuler </button>
                <button type="submit" id="valider" name="modifAdmin"> Valider </button>
            </div>
        </form>
    </section>
</body>

</html>