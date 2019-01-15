<?php
    include 'connection.php';
    $result = pg_query($db_connection, "SELECT * FROM menu");
    echo $result;
?>