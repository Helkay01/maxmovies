<?php
session_start();

if (!isset($_SESSION["id"])) {
    $_SESSION["id"] = uniqid("sess_", true);
}

echo "SESSION ID: " . $_SESSION["id"];
?>
