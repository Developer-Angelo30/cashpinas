<?php
session_start();
unset($_SESSION['adminLog']);
header('location: index.php ');
?>