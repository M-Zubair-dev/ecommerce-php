<?php
include('header.php');
session_start();
unset($_SESSION['IS_LOGIN']);
    redirect('login.php');
?>
