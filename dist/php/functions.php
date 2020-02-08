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
    $mysqli = new mysqli('localhost', 'id12522551_sg_db_admin', 'Z8@0HZA%bp9S', 'id12522551_sg_db');
    if ($mysqli->connect_errno) {
        echo "Error: Failed to make a MySQL connection, here is why: \n";
        echo $mysqli->connect_error;
        exit;
    }
    return $mysqli;
}