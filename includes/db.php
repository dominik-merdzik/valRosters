<?php
    // Global db connecting for all pages
    $db = new PDO('mysql:host=172.31.22.43;dbname=Dominik1169488', 'Dominik1169488', '-OGxho5MTv');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // require 'db.php';