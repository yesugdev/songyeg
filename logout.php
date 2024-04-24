<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$_SESSION = array();

session_destroy();

header("Location: login.php?logout=1");
exit;
?>
