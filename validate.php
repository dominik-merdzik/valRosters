<?php

$username = $_POST['username'];
$password = $_POST['password'];

    require 'includes/db.php';

    $sql = "SELECT * FROM users WHERE username = :username";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
    $cmd->execute();
    $user = $cmd->fetch();


    if (!$user){
        $db = null;
        header('location:login.php?invalid=true');
    }
    else{
        

        if (!password_verify($password, $user['password'])){
    
            $db = null;
            header('location:login.php?invalid=true');
        }
        else {
        
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['userId'] = $user['userId'];
            header('location:list-players.php');
        }

    }

?>