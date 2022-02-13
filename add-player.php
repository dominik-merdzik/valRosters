<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Add new Players</title>
        <link type="text/css" rel="stylesheet" href="css/stylesheet.css"></link>
        <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"></link>
    </head>
    <body>

        
        <header class="header">
            <h1>VAL-ROSTER</h1>
            <h3>2022 VALORANT Player Roaster</h3>
        </header>

        <main class="main">   
            <div> 
                <button onclick="location.href ='index.php'" class="btn btn-secondary btn-sm">Home</button> 
                <button onclick="location.href ='list-players.php'"class="btn btn-secondary btn-sm">List Players</button>  
            </div>
            <div>
            <!-- form will take users input (also doing client side validation) and send it to our save page where we can input it into our database -->
            <form class="form1" method="POST" action="save-player.php">
                    <fieldset>
                        <label for="firstName">First name:*</label>
                        <input name="firstName" id="firstName" required maxlength="20"/>
                    </fieldset>
                    <fieldset>
                        <label for="lastName">Last name:*</label>
                        <input name="lastName" id="lastName" required maxlength="20"/>
                    </fieldset>
                    <fieldset>
                        <label for="alias">In-game username:*</label>
                        <input name="alias" id="alias" required maxlength="20"/>
                    </fieldset>
                    <fieldset>
                        <label for="roleId">Role:*</label>
                        <select name="roleId" id="roleId">

                        <!-- using php to make a dropdown menu which will show them a list of available roles -->
                            <?php
                            require 'db.php'; // connecting to database
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
                        <input name="adr" id="adr" required maxlength="20"/>
                    </fieldset>
                    <!-- submit button what will submit our data to 'save-player.php'-->
                    <button class="btn btn-primary btn-sm">Add player</button>
                </form>
            </div>
        </main>
    </body>
</html>