<?php 
    require 'includes/metadata.php';
?>
<body>
<?php
    require 'includes/header.php';
    ?>

<main class="main">
    <div>
        <!-- creating table with heading for each row-->
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

                <!-- these buttons will be used to sort our data depending on what button is pressed by user-->
                <div>
                    <form class="sortingForm" name="Table Properties" method="post">
                        Sort by:
                        <button type="submit" name="Ascending" id="btn1" class="btn btn-info btn-sm">Ascending </button>
                        <button type="submit" name="Descending" class="btn btn-info btn-sm">Descending </button>
                        <button type="submit" name="Default" class="btn btn-info btn-sm">Default </button>
                    </form>
                </div>


                <?php

                // connecting to data base
                require 'db.php';

                // Reference for sorting buttons https://stackoverflow.com/questions/28475453/php-sort-table-when-submit-button-is-clicked
                // if the x button above is pressed we'll run through these if statments and set variable $sql to a specific script  
                if (isset($_POST['Ascending'])) {
                    $sql = "SELECT valRoster.*,playerRole.roles AS 'playerRole' 
                    FROM valRoster 
                    INNER JOIN playerRole ON valRoster.roleId=playerRole.roleId 
                    ORDER BY valRoster.adr ASC";
                } else if (isset($_POST['Descending'])) {
                    $sql = "SELECT valRoster.*,playerRole.roles AS 'playerRole' 
                    FROM valRoster 
                    INNER JOIN playerRole ON valRoster.roleId=playerRole.roleId 
                    ORDER BY valRoster.adr DESC";
                } else if (isset($_POST['Default'])) {
                    $sql = "SELECT valRoster.*,playerRole.roles AS 'playerRole' FROM valRoster INNER JOIN playerRole ON valRoster.roleId=playerRole.roleId";
                }
                // the else will be our default for when the user first loads into the page
                else {
                    $sql = "SELECT valRoster.*,playerRole.roles AS 'playerRole' FROM valRoster INNER JOIN playerRole ON valRoster.roleId=playerRole.roleId";
                }

                // getting our script ($sql) from our if statments and sending them through to the data base to generate our table dataset
                $cmd = $db->prepare($sql);
                $cmd->execute();
                $valRoster = $cmd->fetchAll();

                // loops through resaults and displays the data from the database inside table cells
                foreach ($valRoster as $valRoster) {
                    //echoing our html table data
                    echo '  <tr> 
                                <td>' . $valRoster['firstName'] . '</td>
                                <td>' . $valRoster['lastName'] . '</td>
                                <td>' . $valRoster['alias'] . '</td>
                                <td>' . $valRoster['playerRole'] . '</td>
                                <td>' . $valRoster['adr'] . '</td>
                                <tr>
                                ';                          
                  }
                // disconnecting from database to reduce traffic 
                $db = null;
                ?>
                
            </tbody>
        </table>
    </div>
    <div class="add-player-btn"> 
        <button onclick="location.href ='add-player.php'" class="btn btn-info">Add New Player</button> 
    </div>
</main>
</body>

</html>