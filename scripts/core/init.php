<?php
if (!isset($_SESSION)) {
  session_start();
}

// Link common files
require_once 'db/connect.php';
require_once 'functions.php';
require_once 'class/login.class.php';
require_once 'class/register.class.php';
//instantiate class

$register = new Register();
$login = new Login();
 ?>
