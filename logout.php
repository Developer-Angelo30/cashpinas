<?php
session_start();
unset($_SESSION['userLog']);
header('location: index.php ');
?>