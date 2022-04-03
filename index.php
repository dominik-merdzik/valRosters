<?php
    $title = 'Welcome';
    require 'includes/header.php';
    ?>
    <body class="index-body">
        <main class="mainIndex">   
            <div class="index-buttons-div"> 
                <!-- buttons to take us to the different pages -->
                <div>
                <button onclick="location.href ='add-player.php'"class="btn btn-secondary ">Add New Player</button> 
                </div>
                <div> 
                <button onclick="location.href ='list-players.php'" class="btn btn-secondary ">Show Current Players</button> 
                </div>
            </div>
        </main>
    </body>
</html>