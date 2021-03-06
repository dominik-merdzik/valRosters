    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>【ValRoster】 <?php echo $title; ?> </title>
        <!--Bootstrap-->
        <link type="text/css" rel="stylesheet" href="css/stylesheet.css"></link>
        <!-- Custom CSS-->
        <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"></link>
        <!--Custom JS-->
        <script src="js/scripts.js" type="text/javascript" defer></script>
        <!-- icon for chrome tabs -->
        <link rel="icon" href="./images/logo.png" alt="logo">
    </head>
    <body>
    <header class="header">
        <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">

        <div class="jm-logo">

        <a href="index.php">

        <img src="./images/logo.png" href="index.php" alt="logo for website - https://www.deviantart.com/frostyhonky/art/Valorant-Tile-840839537" class="logo-img">

        </a> 

        </div>

            <a class="navbar-brand" href="index.php">Valorant Rosters</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="list-players.php">Current players</a>
                    </li>
                    
        <?php
                    // only call session start if not called previously in this http request
                    if (session_status() == PHP_SESSION_NONE) {
                        session_start();
                    }

                    if (!empty($_SESSION['username'])) {
                        echo '
                            <li class="nav-item">
                        <a class="nav-link" href="add-player.php">Add New Player</a>
                    </li>
                    <li class="nav-item">
                                <a class="nav-link" href="my-team.php">My Team</a>
                            </li>
                    ';

                    }
                    ?>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <?php                    
                    if (empty($_SESSION['username'])) {
                        echo '<li class="nav-item">
                                <a class="nav-link" href="register.php">Register</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="login.php">Login</a>
                            </li>';
                    }
                    else {
                        echo '<li class="nav-item">
                                <a class="nav-link" href="#">' . $_SESSION['username'] . '</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="logout.php">Logout</a>
                            </li>';
                    }
                    ?>
    </header>
<body>