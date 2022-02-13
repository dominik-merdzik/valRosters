<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Player List</title>
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
                <button onclick="location.href ='add-player.php'"class="btn1">Add New Player</button>  
            </div>

        <div>
        <table class="table table-striped">
            <thread>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>In-Game Name</th>
                    <th>Role</th>
                    <th>ADR</th>
                </tr>
            </thread>
        <tbody>

        
        <form name="Table Properties" method="post">
        Sort by:
        <button type="submit" name="Ascending" class="button">Ascending </button>
        <button type="submit" name="Descending" class="button">Descending </button>
        <button type="submit" name="Default" class="button">Default </button>
        </form>

            
            <?php

                require 'db.php';

                if(isset($_POST['Ascending'])){
                    $sql="SELECT valRoster.*,playerRole.roles AS 'playerRole' 
                    FROM valRoster 
                    INNER JOIN playerRole ON valRoster.roleId=playerRole.roleId 
                    ORDER BY valRoster.adr ASC";
                }
                else if(isset($_POST['Descending'])){
                    $sql="SELECT valRoster.*,playerRole.roles AS 'playerRole' 
                    FROM valRoster 
                    INNER JOIN playerRole ON valRoster.roleId=playerRole.roleId 
                    ORDER BY valRoster.adr DESC";
                }
                else if (isset($_POST['Default'])){
                    $sql = "SELECT valRoster.*,playerRole.roles AS 'playerRole' FROM valRoster INNER JOIN playerRole ON valRoster.roleId=playerRole.roleId";
                }
                else{
                    $sql = "SELECT valRoster.*,playerRole.roles AS 'playerRole' FROM valRoster INNER JOIN playerRole ON valRoster.roleId=playerRole.roleId";
                }

              
                $cmd = $db->prepare($sql);
                $cmd->execute();
                $valRoster = $cmd->fetchAll();

                // loop through resualts and display inside table cells
                foreach($valRoster as $valRoster){
                    echo '  <tr>
                                <td>' . $valRoster['firstName'] . '</td>
                                <td>'.$valRoster['lastName'] . '</td>
                                <td>' . $valRoster['alias'] . '</td>
                                <td>'.$valRoster['playerRole'] . '</td>
                                <td>'.$valRoster['adr'] . '</td>
                            <tr>';    
                }

                
                
            // disconnect
            
            ?>
        </tbody>
        </table>
        </div>
        </main>
    </body>
</html>