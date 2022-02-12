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
                 <?php

                    $playerName = $_Post['name']; //players first name 
                    $playerSurName = $_Post['lastName']; // players last name
                    $inGameName = $_Post['alias']; // players in game name
                    $inGameRole = $_Post['role']; // players main role in game (Sentinal, initiator, duelist, controller)
                    $adr = $_Post['adr']; // players ADR "Average damage per round"

                    require 'db.php';

                    $sql = "INSERT INTO players (name, lastName, alias, agentRole, adr) VALUES (:name, :lastName, :alias, :agentRole, :adr)";
                    
                    $cmd = $db->prepare($sql);
                    $cmd->bindParam(':name', $name, PDO::PARAM_STR, 100);
                    $cmd->bindParam(':lastName', $playerSurName, PDO::PARAM_STR, 100);
                    $cmd->bindParam(':alias', $inGameName, PDO::PARAM_STR, 50);
                    $cmd->bindParam(':role', $inGameRole, PDO::PARAM_STR, 20);
                    $cmd->bindParam(':adr', $adr, PDO::PARAM_INT);
                    $cmd->execute();

                 ?>
            </div>
        </main>
    </body>
</html>