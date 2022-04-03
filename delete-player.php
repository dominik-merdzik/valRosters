<?php 
    require 'includes/metadata.php';
?>
<body>
<?php
    require 'includes/header.php';
    ?>
<?php
$title = 'Delete player';

    try {

        // get PK from url param and validate it 
        if (isset($_GET['playerId'])) {
            if (is_numeric($_GET['playerId'])) {

                // connect
                require 'includes/db.php';
                // setup and run SQL DELETE
                $userId = $_SESSION['userId'];
                $sql = "DELETE FROM valRoster WHERE playerId = :playerId AND userId = :userId";
                $cmd = $db->prepare($sql);
                $cmd->bindParam(':playerId', $_GET['playerId'], PDO::PARAM_INT);
                $cmd->bindParam(':userId', $userId, PDO::PARAM_INT);
                $cmd->execute();
                // disconnect from
                $db = null;
                //show conformation
                echo '<div class="alert alert-waring">Player has been deleted
                            <a href="my-team.php"> Return to My Team</a>
                            </div>';
            } else {
                echo '<div class="alert alert-waring">Player Missing</div>';
            }
        } else {
            echo '<div class="alert alert-waring">Player Missing</div>';
        }
    } 
    catch (Exception $error) {
        header('location:error.php');
    }
?>
</body>
</html>