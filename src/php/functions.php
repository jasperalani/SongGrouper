<?php

function links(){
    ?>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/environment-min.js"></script>
    <link rel="stylesheet" href="css/theme.css">
<?php
}

function getDB()
{
    $mysqli = new mysqli('127.0.0.1', 'root', '', 'sg_db', 3307);
    if ($mysqli->connect_errno) {
        echo "Error: Failed to make a MySQL connection, here is why: \n";
        echo $mysqli->connect_error;
        exit;
    }
    return $mysqli;
}