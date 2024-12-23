<?php
session_start();
include_once('config.php');

if (!isset($_SESSION['id'])) {
    header('Location: login.php'); 
    exit;
}

if ($_SESSION['is_admin'] == 1) {
    header('Location: admin_dashboard.php');
    exit;
} else {
    header('Location: user_home.php');
    exit;
}


?>