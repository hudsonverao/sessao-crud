<?php
session_start();
$_SESSION['login'] = $_POST['login'];
$_SESSION['pass'] = $_POST['pass'];
?>