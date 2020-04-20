<?php
session_start();
$_SESSION = array();
session_destroy();
header("Location: index.php", true, 303);
exit;
?>