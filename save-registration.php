<?php 
    require 'includes/metadata.php';
?>
<body>
<?php
    
$title = 'Registrating...';
require 'includes/header.php';

// capture form inputs and

$username = $_POST['username'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];
$ok = true;

//validating inputs

if (empty($username)){
    echo '<p class="alert alert-info>Username is required.</p>';
    $ok = false;
}

if (empty($password)){
    echo '<p class="alert alert-info>Password is required.</p>';
    $ok = false;
}

if ($password != $confirm){
    echo '<p class="alert alert-info>Passwords do not match.</p>';
    $ok = false;
}

if ($ok){
    // connect 
    require 'includes/db.php';

    // check for existing username 
    $sql = "SELECT * FROM users WHERE username = :username";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
    $cmd->execute();
    $user = $cmd->fetch();

    if ($user){
        echo '<p class="alert alert-info">Username already exists</p>';
        $db = null;
    }
    else{
        // if username not found then hash password, then save the new username
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username,password) VALUES (:username, :password)";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
        $cmd->bindParam(':password', $password, PDO::PARAM_STR, 255);
        $cmd->execute();

        // disconnect
        $db = null;
        echo '<p class="alert alert-secondary">Registration successful</p>';
        // redirect to login
        header('location:login.php');

    }
}

?>


</body>
</html>