<?php
// call session_start first to try to read any session var
session_start();

// check the seesion for a username var
if (empty($_SESSION['username'])){
    header('Location:login.php');
    exit();
}
