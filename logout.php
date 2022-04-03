<?php
// calling to session to be able to destory it
session_start();
session_destroy();

// relocate user to login page
header('location:login.php');

?>