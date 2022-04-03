<?php
    $title = 'Saving player...';
    require 'includes/header.php';
    ?>
        
        <?php
    try{
            // setting up super gobal variables to later input dataset to database
            // using trim function to trim the user inputs  
            $firstName = trim($_POST['firstName']); //players first name 
            $lastName = trim($_POST['lastName']); // players last name
            $alias = trim($_POST['alias']); // players in game name
            $roleId = $_POST['roleId']; // players main role in game (Sentinal, initiator, duelist, controller)
            $adr = $_POST['adr']; // players ADR "Average damage per round"
            $playerId = $_POST['playerId'];
            $flag = true;

            // light server side validation to check if the user has inputed all of the needed information and 
            // checking if first and last name are not over 25 characters
            // this is done using a flag method 
            if (empty($firstName) || empty($lastName) || empty($alias) || empty($roleId) || empty($adr)) {
                echo "All fields are required <br />";
                $flag = false;
            }
            else if (strlen($firstName) > 25 || strlen($lastName)> 25 || strlen($alias)> 25  ) {
                    echo "First or Last name cannot exceed 25 characters";
                    $flag = false;
            }          

            if ($flag){
                
            //connecting to database    
           require 'includes/db.php';
            
            session_start();
            $userId = $_SESSION['userId'];
            
            if (empty($playerId)) {
                // set the SQL INSERT command to add a new record to our artists table & set up a parameter for the name
                $sql = "INSERT INTO valRoster (firstName, lastName, alias, roleId, adr, userId) VALUES (:firstName, :lastName, :alias, :roleId, :adr, :userId)";
            } 
            else {
                $sql = "UPDATE valRoster 
                SET firstName = :firstName, lastName = :lastName, alias = :alias, roleId = :roleId, adr = :adr, userId = :userId 
                WHERE playerId = :playerId";
            }

            // variable "$sql" gets our sql script through to our database where we input our values
            //$sql = "INSERT INTO valRoster (firstName, lastName, alias, roleId, adr) VALUES (:firstName, :lastName, :alias, :roleId, :adr)";
            
            //preparing to send our scrip to the database but first we need to use bindParam to bind our inputs to the matching values in sql
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':firstName', $firstName, PDO::PARAM_STR, 25);
            $cmd->bindParam(':lastName', $lastName, PDO::PARAM_STR, 25);
            $cmd->bindParam(':alias', $alias, PDO::PARAM_STR, 25);
            $cmd->bindParam(':roleId', $roleId, PDO::PARAM_STR);
            $cmd->bindParam(':adr', $adr, PDO::PARAM_INT);
            $cmd->bindParam(':userId', $userId, PDO::PARAM_INT);

            if(!empty($playerId)){
                $cmd->bindParam(':playerId', $playerId, PDO::PARAM_INT);
            }

            $cmd->execute();
            // once all of our params are binded we can execute the script and bind our user inputs and send them to thier proper column
            
            // disconnecting from database to reduce traffic 
            $db = null;
            // once everything is ran we will give user a message using echo 
            echo 
                '<h1>Player Is Saved <h1/>';
            echo '<a href="list-players.php">Click here to view the list of players</a>';
            }
        } catch (Exception $error) {
            header('location:error.php');
        }
        ?>
           
    </body>
</html>