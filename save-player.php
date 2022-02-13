<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Add new Players</title>
        <link type="text/css" rel="stylesheet" href="css/stylesheet.css"></link>
        <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"></link>
    </head>
    <body>
        
        <?php

            $firstName = trim($_POST['firstName']); //players first name 
            $lastName = trim($_POST['lastName']); // players last name
            $alias = trim($_POST['alias']); // players in game name
            $roleId = $_POST['roleId']; // players main role in game (Sentinal, initiator, duelist, controller)
            $adr = $_POST['adr']; // players ADR "Average damage per round"
            $flag = true;
      
            if (empty($firstName) || empty($lastName) || empty($alias) || empty($roleId) || empty($adr)) {
                echo "All fields are required <br />";
                $flag = false;
            }
            else if (strlen($firstName) > 25 || strlen($lastName)> 25 ) {
                    echo "First or Last name cannot exceed 25 characters";
                    $flag = false;
            }          

            if ($flag){
            require 'db.php';

            $sql = "INSERT INTO valRoster (firstName, lastName, alias, roleId, adr) VALUES (:firstName, :lastName, :alias, :roleId, :adr)";
            
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':firstName', $firstName, PDO::PARAM_STR, 35);
            $cmd->bindParam(':lastName', $lastName, PDO::PARAM_STR, 35);
            $cmd->bindParam(':alias', $alias, PDO::PARAM_STR, 35);
            $cmd->bindParam(':roleId', $roleId, PDO::PARAM_STR);
            $cmd->bindParam(':adr', $adr, PDO::PARAM_INT);
            $cmd->execute();

            $db = null;
            echo 
                '<h1>Player Is Saved <h1/>';
            echo '<a href="list-players.php">Click here to view the list of players</a>';
            }
            
        ?>
           
    </body>
</html>