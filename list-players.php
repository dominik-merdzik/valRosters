<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Player List</title>
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
                <button onclick="location.href ='index.php'"class="btn btn-secondary btn-sm">Home</button> 
                <button onclick="location.href ='add-player.php'"class="btn btn-secondary btn-sm">Add New Player</button>  
            </div>

        <div>
        <table class="table">
            <thread class="thead-dark">
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
        <button type="submit" name="Ascending" id="btn1"class="btn btn-info btn-sm">Ascending </button>
        <button type="submit" name="Descending" class="btn btn-info btn-sm">Descending </button>
        <button type="submit" name="Default" class="btn btn-info btn-sm">Default </button>
        </form>

            
            <?php

                require 'db.php';

                // Reference for sorting buttons https://stackoverflow.com/questions/28475453/php-sort-table-when-submit-button-is-clicked
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

                
                
            // disconnects from db
            $db = null;
            ?>
        </tbody>
        </table>
        </div>
        </main>
    </body>
</html>