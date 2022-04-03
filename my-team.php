<?php
require 'includes/metadata.php';
?>

<body>
    <?php
    require 'includes/header.php';
    ?>
    <h1 class="heading-title">My Team</h1>

    <div class="my-team-buttons">
        <form class="sortingForm" name="Table Properties" method="post">
            Sort ADR by:
            <button type="submit" name="Ascending" id="btn1" class="btn btn-info btn-sm">Ascending </button>
            <button type="submit" name="Descending" class="btn btn-info btn-sm">Descending </button>
            <button type="submit" name="Default" class="btn btn-info btn-sm">Default </button>
        </form>
        <div class="team-buttons-player-add"><button onclick="location.href ='add-player.php'" class="btn btn-secondary btn-sm">Add New Player</button></div>       
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>In-Game Name</th>
                <th>Role</th>
                <th>ADR</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            try {
                // connect
                require 'includes/db.php';

                // set up & run query
                // now filter for the authenticated user by their userId stored in a session var
                if (isset($_POST['Ascending'])) {
                    $sql = "SELECT valRoster.*,playerRole.roles AS 'playerRole' 
                FROM valRoster 
                INNER JOIN playerRole ON valRoster.roleId=playerRole.roleId 
                WHERE userId = :userId
                ORDER BY valRoster.adr ASC";
                } else if (isset($_POST['Descending'])) {
                    $sql = "SELECT valRoster.*,playerRole.roles AS 'playerRole' 
                FROM valRoster 
                INNER JOIN playerRole ON valRoster.roleId=playerRole.roleId 
                WHERE userId = :userId
                ORDER BY valRoster.adr DESC";
                } else if (isset($_POST['Default'])) {
                    $sql = "SELECT valRoster.*,playerRole.roles AS 'playerRole' FROM valRoster INNER JOIN playerRole ON valRoster.roleId=playerRole.roleId WHERE userId = :userId";
                }
                // the else will be our default for when the user first loads into the page
                else {
                    $sql = "SELECT valRoster.*,playerRole.roles AS 'playerRole' FROM valRoster INNER JOIN playerRole ON valRoster.roleId=playerRole.roleId WHERE userId = :userId";
                }

                $cmd = $db->prepare($sql);
                $cmd->bindParam(':userId', $_SESSION['userId'], PDO::PARAM_INT);
                $cmd->execute();
                $valRoster = $cmd->fetchAll();

                // loop through results and display inside table cells
                foreach ($valRoster as $valRoster) {
                    //echoing our html table data
                    echo '  <tr> 
                            <td>
                            <a href="add-player.php?playerId=' . $valRoster['playerId'] . '">' . $valRoster['firstName'] . '
                            </td>
                            <td>' . $valRoster['lastName'] . '</td>
                            <td>' . $valRoster['alias'] . '</td>
                            <td>' . $valRoster['playerRole'] . '</td>
                            <td>' . $valRoster['adr'] . '</td>
                            <td>
                            <a href="delete-player.php?playerId=' . $valRoster['playerId'] . '" class="btn btn-danger"
                                onclick="return confirmDelete()">
                                Delete
                            </a>
                            </td>
                            <tr>
                            ';
                }
                // disconnect
                $db = null;
            } catch (Exception $error) {
                header('location:error.php'); // redirect to error page
            }
            ?>
        </tbody>
    </table>
    </main>
</body>

</html>