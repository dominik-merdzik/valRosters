<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Add new Players</title>
        <link type="text/css" rel="stylesheet" href="css/stylesheet.css"></link>
    </head>
    <body>

        
        <header class="header">
            <h1>VAL-ROSTER</h1>
            <h3>2022 VALORANT Player Roaster</h3>
        </header>
        <main>   
            <div> 
                <button onclick="location.href ='index.php'"class="btn1">Home</button> 
                <button onclick="location.href ='list-players.php'"class="btn1">List Players</button>  
            </div>
            <div>
            <form method="POST" action="save-player.php">
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
                            
                            <?php
                            require 'db.php';
                            $sql = "SELECT * FROM playerRole";

                            $cmd = $db->prepare($sql);
                            $cmd->execute();
                            $roles = $cmd->fetchAll();

                            foreach($roles as $role){
                                echo '<option value="'. $role['roleId'].'">' . $role['roles'] . '</option>';
                            }
                            $db = null;
                            ?>

                        </select>
                    </fieldset>
                    <fieldset>
                        <label for="adr">ADR:*</label>
                        <input name="adr" id="adr" required maxlength="20"/>
                    </fieldset>
                    <button>Save</button>
                </form>
            </div>
        </main>
    </body>
</html>