<?php

require "../controllers/faq.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Foire Aux Questions</title>
    <link rel="stylesheet" type="text/css" href="css/faq.css" />
    <link rel="stylesheet" type="text/css" href="css/header-footer.css" />
</head>

<body>
    <?php require "_header.php"; ?>
    <main>
        <header>
            <h1>Foire Aux Questions</h1>
        </header>
        <?php echo $faq ?>
        <footer>
            Vous n'avez pas trouvé votre réponse ?
            <a href="mailto:administration@infinite-measures.com?subject=Question">Posez votre question ici</a>
            <h5>Le lien <code>mailto</code> ne fonctionne pas ? Envoyez un mail à l'adresse <code>administration@infinite-measures.com</code>.</h5>
        </footer>
    </main>
    <?php require "_footer.html"; ?>
</body>

</html>
