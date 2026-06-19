<?php
session_start();
include 'includes/functions.php';
if (!isset($_SESSION['role'])) { header('Location: index.php'); exit(); }
header('Location: ' . redirect_by_role($_SESSION['role']));
exit();
?>
