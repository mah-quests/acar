<?php
session_start();
//session_destroy();

	unset($_SESSION['username']);
    unset($_SESSION['password']);
    setcookie('username', null, -1, '/');
    setcookie('password', null, -1, '/');
    session_destroy();

    header('Location:login.php');

 ?>