<?php
session_start();
unset($_SESSION['name']);
unset($_SESSION['loggedin']);
unset($_SESSION['email']);
unset($_SESSION['user_id']);
unset($_SESSION['success_msg']);
session_destroy();
header("Location:auth/login.php");
?>