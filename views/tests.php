<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
	require "../controllers/end_exam.php";
}
if (isset($_COOKIE["testError"])) {
    $test = $_COOKIE["testError"];
    setcookie("testError");
    echo "<script>alert('Une valeur incohérente a été rentrée pour le test : ".$test."');</script>";
}
?><!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Tests</title>
    <link rel="stylesheet" type="text/css" href="css/tests.css" />
    <script type="text/javascript" src="js/tests.js"></script>
</head>

<body onload="initTests();" class="<?php echo $_SESSION["exam_tests"]; ?>">
    <main>
        <div>
            <img id="test-icon" />
            <h1 id="test-title">Sample test</h1>
            <p id="test-desc">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae doloribus placeat quisquam odit ex aspernatur distinctio ratione, sunt ipsa sapiente magnam nesciunt dolorem iure quis optio eos quia. Blanditiis, illo.
            </p>
        </div>
        <div>
            <table id="results">
                <thead>
                    <tr>
                        <th colspan="2">Résultats des tests</th>
                    </tr>
                </thead>
                <tbody>
                    <template id="template-result">
                        <tr>
                            <th scope="row">Test</th>
                            <td>&nbsp;</td>
                        </tr>
                    </template>
                </tbody>
            </table>
            <form id="input">
                <input name="value" type="number" placeholder="Entrer une valeur manuelle" required />
                <button type="submit" onclick="enterValue();">Enregistrer</button>
            </form>
            <form id="submit" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" hidden>
                <template id="template-submit">
                    <input type="number" hidden />
                </template>
                <button type="submit">Terminer</button>
            </form>
        </div>
    </main>
</body>

</html>
