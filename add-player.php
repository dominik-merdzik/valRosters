<?php 
    require 'includes/metadata.php';
?>
<body>
<?php
    require 'includes/header.php';
    ?>

        <main class="main">   
            
            <?php

                try{
                // check for artistId url param. If we have one, query db & populate form. If not show blank form
                $playerId = null;
                $firstName = null; //players first name 
                $lastName = null; // players last name
                $alias = null; // players in game name
                $roleId = null; // players main role in game (Sentinal, initiator, duelist, controller)
                $adr = null; // players ADR "Average damage per round"

                if (isset($_GET['playerId'])) {
                    if (is_numeric($_GET['playerId'])) {
                        $playerId = $_GET['playerId'];

                        require 'includes/db.php';

                        // add userID filter so users can only see thier own artist 
                        
                        $userId = $_SESSION['userId'];
                        $sql = "SELECT * FROM valRoster WHERE playerId=:playerId AND userId = :userId";
                        $cmd = $db->prepare($sql);
                        $cmd->bindParam(':playerId', $playerId, PDO::PARAM_INT);
                        $cmd->bindParam(':userId', $userId, PDO::PARAM_INT);
                        $cmd->execute();
                        $valRoster = $cmd->fetch(); // use fetch() not fetchAll() for single-row queries
                        if (empty($valRoster)){
                            $db = null;
                            header('Location:error212.php');
                            exit();
                        }
                            else{
                                $firstName = $valRoster['firstName']; //players first name 
                                $lastName = $valRoster['lastName']; // players last name
                                $alias = $valRoster['alias']; // players in game name
                                $roleId = $valRoster['roleId']; // players main role in game (Sentinal, initiator, duelist, controller)
                                $adr = $valRoster['adr']; // players ADR "Average damage per round"
                                $db = null;
                            }
                        }
                    }
                }
                catch(Exception $error){
                    header('location:error.php');
                }
            ?>

            <div>
            <!-- form will take users input (also doing client side validation) and send it to our save page where we can input it into our database -->
            <form class="form1" method="POST" action="save-player.php">
                    <fieldset>
                        <label for="firstName">First name:*</label>
                        <input name="firstName" id="firstName" required maxlength="100" value="<?php echo $firstName; ?>" />
                    </fieldset>
                    <fieldset>
                        <label for="lastName">Last name:*</label>
                        <input name="lastName" id="lastName" required maxlength="100" value="<?php echo $lastName; ?>" />
                    </fieldset>
                    <fieldset>
                        <label for="alias">In-game username:*</label>
                        <input name="alias" id="alias" required maxlength="100" value="<?php echo $alias; ?>" />
                    </fieldset>
                    <fieldset>
                        <label for="roleId">Role:*</label>
                        <select name="roleId" id="roleId">

                        <!-- using php to make a dropdown menu which will show them a list of available roles -->
                            <?php
                            require 'includes/db.php'; // connecting to database
                            // selecting "all" from playerRole table in our data base
                            $sql = "SELECT * FROM playerRole";

                            // running scrip and fetching all our the data returned
                            $cmd = $db->prepare($sql);
                            $cmd->execute();
                            $roles = $cmd->fetchAll();

                            // looping all the data we returned to display in a dropdown menu 
                            foreach($roles as $role){
                                echo '<option value="'. $role['roleId'].'">' . $role['roles'] . '</option>';
                            }
                            // disconnecting from database to reduce traffic 
                            $db = null;
                            ?>

                        </select>
                    </fieldset>
                    <fieldset>
                        <label for="adr">ADR:*</label>
                        <input name="adr" id="adr" required maxlength="100" value="<?php echo $adr; ?>" />
                    </fieldset>
                    <!-- submit button what will submit our data to 'save-player.php'-->
                    <input type="hidden" name="playerId" id="playerId" value="<?php echo $playerId; ?>" />
                    <button class="btn btn-primary btn-sm">Save player</button>
                </form>
            </div>
        </main>
    </body>
</html>